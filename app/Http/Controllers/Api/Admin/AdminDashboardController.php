<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    /**
     * Get comprehensive dashboard data
     */
    public function index(Request $request)
    {
        try {
            $today = now()->startOfDay();
            $tomorrow = now()->endOfDay();
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();

            // Basic stats
            $stats = [
                // Overview stats
                'total_orders' => Order::count(),
                'total_revenue' => Order::where('status', 'COMPLETED')->sum('total_price'),
                'total_menu' => Menu::count(),
                'total_users' => User::count(),

                // Today's stats
                'today_orders' => Order::whereBetween('created_at', [$today, $tomorrow])->count(),
                'today_revenue' => Order::where('status', 'COMPLETED')
                    ->whereBetween('created_at', [$today, $tomorrow])
                    ->sum('total_price'),

                // Order status breakdown
                'orders_by_status' => [
                    'pending' => Order::where('status', 'PENDING')->count(),
                    'processing' => Order::where('status', 'PROCESSING')->count(),
                    'completed' => Order::where('status', 'COMPLETED')->count(),
                    'cancelled' => Order::where('status', 'CANCELLED')->count(),
                ],

                // Delivery type breakdown
                'orders_by_delivery' => [
                    'delivery' => Order::where('delivery_type', 'delivery')->count(),
                    'pickup' => Order::where('delivery_type', 'pickup')->count(),
                ],

                // Stock stats
                'stock_stats' => [
                    'total_items' => Menu::sum('stock'),
                    'low_stock' => Menu::where('stock', '<', 10)->where('stock', '>', 0)->count(),
                    'out_of_stock' => Menu::where('stock', '<=', 0)->count(),
                    'available_items' => Menu::where('stock', '>', 0)->count(),
                ],

                // Revenue stats
                'revenue' => [
                    'today' => Order::where('status', 'COMPLETED')
                        ->whereBetween('created_at', [$today, $tomorrow])
                        ->sum('total_price'),
                    'this_week' => Order::where('status', 'COMPLETED')
                        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->sum('total_price'),
                    'this_month' => Order::where('status', 'COMPLETED')
                        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->sum('total_price'),
                    'average_order_value' => Order::where('status', 'COMPLETED')->avg('total_price') ?? 0,
                ],
            ];

            // Recent activities
            $recentOrders = Order::with('user')
                ->latest()
                ->limit(10)
                ->get(['id', 'order_number', 'user_id', 'total_price', 'status', 'created_at']);

            // Popular menu items (top 5)
            $popularMenus = DB::table('order_items')
                ->join('menus', 'order_items.menu_id', '=', 'menus.id')
                ->select('menus.id', 'menus.name', 'menus.image', DB::raw('SUM(order_items.qty) as total_sold'))
                ->groupBy('menus.id', 'menus.name', 'menus.image')
                ->orderBy('total_sold', 'desc')
                ->limit(5)
                ->get();

            // Revenue chart data (last 7 days)
            $revenueChart = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $dayName = now()->subDays($i)->format('D');

                $revenue = Order::where('status', 'COMPLETED')
                    ->whereDate('created_at', $date)
                    ->sum('total_price');

                $orders = Order::whereDate('created_at', $date)->count();

                $revenueChart[] = [
                    'date' => $dayName,
                    'revenue' => $revenue,
                    'orders' => $orders
                ];
            }

            return response()->json([
                'success' => true,
                'message' => 'Dashboard data retrieved successfully',
                'data' => [
                    'stats' => $stats,
                    'recent_orders' => $recentOrders,
                    'popular_menus' => $popularMenus,
                    'revenue_chart' => $revenueChart
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to fetch dashboard data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch dashboard data'
            ], 500);
        }
    }

    /**
     * Get revenue report with date range
     */
    public function getRevenueReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'group_by' => 'sometimes|in:day,week,month'
        ]);

        try {
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $groupBy = $request->get('group_by', 'day');

            $query = Order::where('status', 'COMPLETED')
                ->whereBetween('created_at', [$startDate, $endDate]);

            // Group by based on parameter
            switch ($groupBy) {
                case 'week':
                    $revenueData = $query->get()
                        ->groupBy(function($date) {
                            return $date->created_at->format('W-Y');
                        })
                        ->map(function($group) {
                            return [
                                'period' => $group->first()->created_at->format('d M') . ' - ' . $group->last()->created_at->format('d M'),
                                'revenue' => $group->sum('total_price'),
                                'orders' => $group->count()
                            ];
                        })->values();
                    break;

                case 'month':
                    $revenueData = $query->get()
                        ->groupBy(function($date) {
                            return $date->created_at->format('M Y');
                        })
                        ->map(function($group) {
                            return [
                                'period' => $group->first()->created_at->format('F Y'),
                                'revenue' => $group->sum('total_price'),
                                'orders' => $group->count()
                            ];
                        })->values();
                    break;

                case 'day':
                default:
                    $revenueData = $query->get()
                        ->groupBy(function($date) {
                            return $date->created_at->format('Y-m-d');
                        })
                        ->map(function($group) {
                            return [
                                'date' => $group->first()->created_at->format('d M'),
                                'revenue' => $group->sum('total_price'),
                                'orders' => $group->count()
                            ];
                        })->values();
                    break;
            }

            $summary = [
                'total_revenue' => $query->sum('total_price'),
                'total_orders' => $query->count(),
                'average_order' => $query->avg('total_price') ?? 0,
                'period' => [
                    'start' => $startDate,
                    'end' => $endDate
                ]
            ];

            return response()->json([
                'success' => true,
                'message' => 'Revenue report retrieved successfully',
                'data' => [
                    'summary' => $summary,
                    'chart_data' => $revenueData
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to generate revenue report: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate revenue report'
            ], 500);
        }
    }
}
