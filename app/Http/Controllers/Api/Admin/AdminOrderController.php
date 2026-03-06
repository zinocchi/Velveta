<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminOrderController extends Controller
{
    /**     */
    public function index(Request $request)
    {
        try {
            $query = Order::with(['user', 'items.menu'])
                ->latest();

            if ($request->has('status') && $request->status) {
                $query->where('status', $request->status);
            }

            if ($request->has('date_from') && $request->date_from) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->has('date_to') && $request->date_to) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            if ($request->has('delivery_type') && $request->delivery_type) {
                $query->where('delivery_type', $request->delivery_type);
            }


            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('order_number', 'like', "%{$search}%")
                      ->orWhereHas('user', function($userQuery) use ($search) {
                          $userQuery->where('name', 'like', "%{$search}%");
                      });
                });
            }

            $orders = $query->paginate(20);

            return response()->json([
                'success' => true,
                'message' => 'Orders retrieved successfully',
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

    /**
     * Get single order details
     */
    public function show($id)
    {
        try {
            $order = Order::with(['user', 'items.menu'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Order retrieved successfully',
                'data' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }
    }

    /**
     * Update order status (PROCESSING, COMPLETED, CANCELLED)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:PROCESSING,COMPLETED,CANCELLED,PENDING'
        ]);

        DB::beginTransaction();

        try {
            $order = Order::with('items')->findOrFail($id);
            $oldStatus = $order->status;
            $newStatus = $request->status;


            if ($newStatus === 'CANCELLED' && $oldStatus !== 'CANCELLED') {
                foreach ($order->items as $item) {
                    $menu = Menu::find($item->menu_id);
                    if ($menu) {
                        $menu->stock += $item->qty;
                        $menu->save();

                        Log::info('Stock restored for cancelled order', [
                            'order_id' => $order->id,
                            'menu_id' => $menu->id,
                            'qty' => $item->qty
                        ]);
                    }
                }
            }

            // Handle stock reduction if order is reactivated from cancelled
            if ($oldStatus === 'CANCELLED' && $newStatus !== 'CANCELLED') {
                foreach ($order->items as $item) {
                    $menu = Menu::find($item->menu_id);
                    if ($menu) {
                        if ($menu->stock < $item->qty) {
                            throw new \Exception("Insufficient stock for menu: {$menu->name}");
                        }
                        $menu->stock -= $item->qty;
                        $menu->save();
                    }
                }
            }

            $order->status = $newStatus;
            $order->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
                'data' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'old_status' => $oldStatus,
                    'new_status' => $order->status
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update order status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk update order status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array|min:1',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|string|in:PROCESSING,COMPLETED,CANCELLED'
        ]);

        DB::beginTransaction();

        try {
            $orders = Order::with('items')->whereIn('id', $request->order_ids)->get();
            $updatedCount = 0;

            foreach ($orders as $order) {
                if ($order->status !== $request->status) {
                    if ($request->status === 'CANCELLED' && $order->status !== 'CANCELLED') {
                        foreach ($order->items as $item) {
                            $menu = Menu::find($item->menu_id);
                            if ($menu) {
                                $menu->stock += $item->qty;
                                $menu->save();
                            }
                        }
                    }

                    $order->status = $request->status;
                    $order->save();
                    $updatedCount++;
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "{$updatedCount} orders updated successfully",
                'data' => [
                    'updated_count' => $updatedCount,
                    'new_status' => $request->status
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to bulk update orders: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update orders'
            ], 500);
        }
    }

    /**
     * Get orders statistics for dashboard
     */
    public function getStatistics(Request $request)
    {
        try {
            $today = now()->startOfDay();
            $tomorrow = now()->endOfDay();

            $stats = [
                'total_orders' => Order::count(),
                'pending_orders' => Order::where('status', 'PENDING')->count(),
                'processing_orders' => Order::where('status', 'PROCESSING')->count(),
                'completed_orders' => Order::where('status', 'COMPLETED')->count(),
                'cancelled_orders' => Order::where('status', 'CANCELLED')->count(),
                'today_orders' => Order::whereBetween('created_at', [$today, $tomorrow])->count(),
                'today_revenue' => Order::where('status', 'COMPLETED')
                    ->whereBetween('created_at', [$today, $tomorrow])
                    ->sum('total_price'),
                'total_revenue' => Order::where('status', 'COMPLETED')->sum('total_price'),
                'average_order_value' => Order::where('status', 'COMPLETED')->avg('total_price') ?? 0,
            ];

            return response()->json([
                'success' => true,
                'message' => 'Statistics retrieved successfully',
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch statistics: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch statistics'
            ], 500);
        }
    }

    /**
     * Get recent orders for dashboard
     */
    public function getRecentOrders()
    {
        try {
            $recentOrders = Order::with('user')
                ->latest()
                ->limit(10)
                ->get(['id', 'order_number', 'user_id', 'total_price', 'status', 'created_at']);

            return response()->json([
                'success' => true,
                'message' => 'Recent orders retrieved successfully',
                'data' => $recentOrders
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch recent orders: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch recent orders'
            ], 500);
        }
    }
}
