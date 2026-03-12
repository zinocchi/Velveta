<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use App\Models\PaymentMethod;
use App\Models\EWalletProvider;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $orders = $request->user()->orders()
                ->with(['items.menu', 'paymentMethod', 'eWalletProvider', 'bank'])
                ->latest()
                ->get();

            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch orders: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch orders'
            ], 500);
        }
    }

    private function generateOrderNumber()
    {
        do {
            $number = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }

    public function store(Request $request)
    {
        Log::info('=== ORDER CREATION STARTED ===');
        Log::info('Request data:', $request->all());

        $rules = [
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:credit_card,e_wallet,bank_transfer,cash',
            'delivery_type' => 'required|string|in:delivery,pickup',
            'shipping_cost' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ];

        // Validasi payment details berdasarkan metode
        if (in_array($request->payment_method, ['credit_card', 'e_wallet', 'bank_transfer'])) {
            $rules['payment_details'] = 'required|array';

            switch ($request->payment_method) {
                case 'credit_card':
                    $rules['payment_details.card_number'] = 'required|string';
                    $rules['payment_details.card_holder'] = 'required|string';
                    $rules['payment_details.expiry'] = 'required|string';
                    $rules['payment_details.cvv'] = 'required|string|size:3';
                    break;

                case 'e_wallet':
                    $rules['payment_details.provider'] = 'required|string|in:OVO,GoPay,DANA';
                    $rules['payment_details.phone'] = 'required|string|regex:/^08[0-9]{8,11}$/';
                    break;

                case 'bank_transfer':
                    $rules['payment_details.bank'] = 'required|string|in:BCA,Mandiri,BNI,BRI';
                    break;
            }
        }

        if ($request->delivery_type === 'delivery') {
            $rules['shipping_address'] = 'required|array';
            $rules['shipping_address.recipientName'] = 'required|string';
            $rules['shipping_address.phoneNumber'] = 'required|string';
            $rules['shipping_address.address'] = 'required|string';
            $rules['shipping_address.city'] = 'required|string';
            $rules['shipping_address.postalCode'] = 'required|string';
        }

        try {
            $validatedData = $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            // Hitung ulang total
            $calculatedItemsTotal = 0;
            $stockCheck = [];

            foreach ($request->items as $item) {
                $menu = Menu::lockForUpdate()->find($item['id']);

                if (!$menu) {
                    throw new \Exception("Menu with ID {$item['id']} not found");
                }

                if ($menu->stock < $item['qty']) {
                    throw new \Exception("Stock for {$menu->name} is not enough. Available: {$menu->stock}, Requested: {$item['qty']}");
                }

                $calculatedItemsTotal += $menu->price * $item['qty'];
                $stockCheck[] = [
                    'menu' => $menu,
                    'qty' => $item['qty']
                ];
            }

            $finalTotal = $calculatedItemsTotal + $request->shipping_cost;

            if (abs($finalTotal - $request->total) > 0.01) {
                throw new \Exception('Total price mismatch. Please refresh your cart.');
            }

            // Siapkan data order
            $orderData = [
                'user_id' => $request->user()->id,
                'order_number' => $this->generateOrderNumber(),
                'total_price' => $finalTotal,
                'status' => 'PROCESSING',
                'payment_method' => $request->payment_method,
                'delivery_type' => $request->delivery_type,
                'shipping_cost' => $request->shipping_cost,
            ];

            // Simpan payment details
            if ($request->has('payment_details')) {
                $orderData['payment_details'] = $request->payment_details;

                // Simpan field spesifik untuk relasi
                if ($request->payment_method === 'e_wallet') {
                    $orderData['e_wallet_provider'] = $request->payment_details['provider'];
                } elseif ($request->payment_method === 'bank_transfer') {
                    $orderData['bank_code'] = $request->payment_details['bank'];
                } elseif ($request->payment_method === 'credit_card') {
                    $orderData['card_last4'] = substr(str_replace(' ', '', $request->payment_details['card_number']), -4);
                }
            }

            // Shipping address
            if ($request->delivery_type === 'delivery' && $request->has('shipping_address')) {
                $orderData['shipping_address'] = [
                    'recipient_name' => $request->shipping_address['recipientName'] ?? null,
                    'phone_number' => $request->shipping_address['phoneNumber'] ?? null,
                    'address' => $request->shipping_address['address'] ?? null,
                    'detail' => $request->shipping_address['detail'] ?? '',
                    'city' => $request->shipping_address['city'] ?? null,
                    'postal_code' => $request->shipping_address['postalCode'] ?? null,
                ];
                $orderData['estimated_minutes'] = 45;
            } else {
                $orderData['estimated_minutes'] = 15;
            }

            // Delivery option
            if ($request->has('delivery_option')) {
                $orderData['delivery_option'] = $request->delivery_option;
            }

            $order = Order::create($orderData);

            // Kurangi stok dan buat order items
            foreach ($stockCheck as $item) {
                $menu = $item['menu'];
                $menu->stock -= $item['qty'];
                $menu->save();

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $item['qty'],
                    'price' => $menu->price,
                ]);
            }

            DB::commit();

            // Load relasi untuk response
            $order->load(['paymentMethod', 'eWalletProvider', 'bank', 'items.menu']);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'data' => [
                    'order' => $order,
                    'payment_instructions' => $this->getPaymentInstructions($order)
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function getPaymentInstructions($order)
    {
        $instructions = [];

        if ($order->payment_method === 'bank_transfer') {
            $bankAccounts = [
                'BCA' => ['account' => '1234567890', 'name' => 'PT Velveta Coffee'],
                'Mandiri' => ['account' => '0987654321', 'name' => 'PT Velveta Coffee'],
                'BNI' => ['account' => '1122334455', 'name' => 'PT Velveta Coffee'],
                'BRI' => ['account' => '5544332211', 'name' => 'PT Velveta Coffee']
            ];

            $selectedBank = $order->payment_details['bank'] ?? 'BCA';

            $instructions = [
                'type' => 'bank_transfer',
                'bank_name' => $selectedBank,
                'account_number' => $bankAccounts[$selectedBank]['account'],
                'account_name' => $bankAccounts[$selectedBank]['name'],
                'amount' => $order->total_price,
                'expiry_hours' => 24,
                'unique_code' => rand(100, 999)
            ];
        } elseif ($order->payment_method === 'e_wallet') {
            $instructions = [
                'type' => 'e_wallet',
                'provider' => $order->payment_details['provider'] ?? '',
                'phone' => $order->payment_details['phone'] ?? '',
                'amount' => $order->total_price,
                'steps' => [
                    'Open your ' . ($order->payment_details['provider'] ?? '') . ' app',
                    'Select "Pay" or "Scan"',
                    'Enter the amount or scan QR code',
                    'Confirm payment'
                ]
            ];
        }

        return $instructions;
    }

    public function myOrder()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $orders = Order::with(['items.menu', 'paymentMethod', 'eWalletProvider', 'bank'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function show($id)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated'
                ], 401);
            }

            $order = Order::with(['items.menu', 'paymentMethod', 'eWalletProvider', 'bank'])
                ->where('id', $id)
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            if ($order->user_id !== $user->id && $user->role !== 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|string|in:PENDING,PROCESSING,COMPLETED,CANCELLED'
            ]);

            DB::beginTransaction();

            $order = Order::with('items')->findOrFail($id);
            $oldStatus = $order->status;

            if ($request->status === 'CANCELLED' && $oldStatus !== 'CANCELLED') {
                Log::info('Order cancellation initiated', [
                    'order_id' => $order->id,
                    'old_status' => $oldStatus
                ]);

                foreach ($order->items as $item) {
                    $menu = Menu::lockForUpdate()->find($item->menu_id);

                    if ($menu) {
                        $menu->stock += $item->qty;
                        $menu->save();

                        Log::info('Stock restored for cancelled order:', [
                            'order_id' => $order->id,
                            'menu_id' => $menu->id,
                            'menu_name' => $menu->name,
                            'previous_stock' => $menu->stock - $item->qty,
                            'new_stock' => $menu->stock,
                            'qty_restored' => $item->qty
                        ]);
                    }
                }
            }

            if ($oldStatus === 'CANCELLED' && $request->status !== 'CANCELLED') {
                Log::info('Order reactivation initiated', [
                    'order_id' => $order->id,
                    'new_status' => $request->status
                ]);

                foreach ($order->items as $item) {
                    $menu = Menu::lockForUpdate()->find($item->menu_id);

                    if (!$menu) {
                        throw new \Exception("Menu with ID {$item->menu_id} not found");
                    }

                    if ($menu->stock < $item->qty) {
                        throw new \Exception("Cannot reactivate order. Insufficient stock for {$menu->name}. Available: {$menu->stock}, Required: {$item->qty}");
                    }

                    $menu->stock -= $item->qty;
                    $menu->save();

                    Log::info('Stock reduced for reactivated order:', [
                        'order_id' => $order->id,
                        'menu_id' => $menu->id,
                        'menu_name' => $menu->name,
                        'previous_stock' => $menu->stock + $item->qty,
                        'new_stock' => $menu->stock,
                        'qty_reduced' => $item->qty
                    ]);
                }
            }

            $order->status = $request->status;
            $order->save();

            DB::commit();

            Log::info('Order status updated', [
                'order_id' => $order->id,
                'old_status' => $oldStatus,
                'new_status' => $order->status,
                'updated_by' => $request->user()->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
                'data' => $order
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update order status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkPaymentStatus($id)
    {
        try {
            $order = Order::findOrFail($id);

            if ($order->paid_at) {
                return response()->json([
                    'success' => true,
                    'paid' => true,
                    'paid_at' => $order->paid_at
                ]);
            }

            return response()->json([
                'success' => true,
                'paid' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to check payment status'
            ], 500);
        }
    }
}
