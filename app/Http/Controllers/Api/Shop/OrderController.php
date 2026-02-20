<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Closure;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {
            $orders = $request->user()->orders()
                ->with(['items.menu'])
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
        } while (
            \App\Models\Order::where('order_number', $number)->exists()
        );

        return $number;
    }

    public function store(Request $request)
    {
        Log::info('=== ORDER CREATION STARTED ===');
        Log::info('Request data:', $request->all());
        Log::info('Request user:', ['user_id' => $request->user()?->id]);

        $rules = [
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'delivery_type' => 'required|string|in:delivery,pickup',
            'shipping_cost' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ];

        if ($request->delivery_type === 'delivery') {
            Log::info('Validating for delivery type');
            $rules['shipping_address'] = 'required|array';

            if ($request->has('shipping_address') && is_array($request->shipping_address)) {
                Log::info('Shipping address keys:', array_keys($request->shipping_address));
            }
        } else {
            Log::info('Validating for pickup type');

            $rules['shipping_address'] = 'nullable';
        }

        if ($request->has('delivery_option') && $request->delivery_option) {
            Log::info('Has delivery option');
            $rules['delivery_option'] = 'nullable|array';
        }

        try {
            $validatedData = $request->validate($rules);
            Log::info('Validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $calculatedItemsTotal = 0;
            $itemsDetail = [];

            foreach ($request->items as $item) {
                $menu = Menu::find($item['id']);

                if (!$menu) {
                    throw new \Exception("Menu with ID {$item['id']} not found");
                }

                Log::info('Processing item:', [
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'menu_price' => $menu->price,
                    'qty' => $item['qty']
                ]);

                $calculatedItemsTotal += $menu->price * $item['qty'];
                $itemsDetail[] = [
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'qty' => $item['qty']
                ];
            }

            $finalTotal = $calculatedItemsTotal + $request->shipping_cost;
            Log::info('Calculated totals:', [
                'items_total' => $calculatedItemsTotal,
                'shipping_cost' => $request->shipping_cost,
                'final_total' => $finalTotal,
                'client_total' => $request->total
            ]);

            if (abs($finalTotal - $request->total) > 0.01) {
                throw new \Exception('Total price mismatch. Please refresh your cart.');
            }

            $orderData = [
                'user_id' => $request->user()->id,
                'order_number' => $this->generateOrderNumber(),
                'total_price' => $finalTotal,
                'status' => 'PENDING',
                'payment_method' => $request->payment_method,
                'delivery_type' => $request->delivery_type,
                'shipping_cost' => $request->shipping_cost,
            ];

            if ($request->delivery_type === 'delivery' && $request->has('shipping_address') && $request->shipping_address) {
                Log::info('Processing shipping address');
                $orderData['shipping_address'] = [
                    'id' => $request->shipping_address['id'] ?? null,
                    'recipient_name' => $request->shipping_address['recipientName'] ?? null,
                    'phone_number' => $request->shipping_address['phoneNumber'] ?? null,
                    'address' => $request->shipping_address['address'] ?? null,
                    'detail' => $request->shipping_address['detail'] ?? '',
                    'city' => $request->shipping_address['city'] ?? null,
                    'postal_code' => $request->shipping_address['postalCode'] ?? null,
                    'full_address' => $request->shipping_address['full_address'] ?? null,
                ];

                $orderData['estimated_minutes'] = 45; // default delivery time
            }

            if ($request->has('delivery_option') && $request->delivery_option) {
                Log::info('Processing delivery option');
                $orderData['delivery_option'] = [
                    'id' => $request->delivery_option['id'] ?? null,
                    'name' => $request->delivery_option['name'] ?? null,
                    'price' => $request->delivery_option['price'] ?? null,
                ];
            }

            if ($request->delivery_type === 'pickup') {
                $orderData['estimated_minutes'] = 15;
            }

            Log::info('Order data to be created:', $orderData);

            // Create order
            $order = Order::create($orderData);
            Log::info('Order created with ID: ' . $order->id);

            // Create order items
            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['id']);

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $item['qty'],
                    'price' => $menu->price,
                ]);

                Log::info('Order item created:', [
                    'order_item_id' => $orderItem->id,
                    'menu_id' => $menu->id,
                    'qty' => $item['qty']
                ]);
            }

            DB::commit();
            Log::info('Transaction committed successfully');

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'data' => [
                    'order_id' => $order->id,
                    'status' => $order->status,
                    'total' => $order->total_price,
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Order creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|string|in:PENDING,PROCESSING,COMPLETED,CANCELLED'
            ]);

            $order = Order::findOrFail($id);

            $order->status = $request->status;
            $order->save();

            Log::info('Order status updated', [
                'order_id' => $order->id,
                'new_status' => $order->status,
                'updated_by' => $request->user()->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order status updated',
                'data' => $order
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Failed to update order status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status'
            ], 500);
        }
    }

    /**
     * Admin middleware handler
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden. Admin access required.'
            ], 403);
        }

        return $next($request);
    }

    public function myOrder ()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $orders = Order::with('items.menu')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }
}
    