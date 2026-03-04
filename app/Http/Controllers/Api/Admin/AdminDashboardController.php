<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Menu;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'users' => User::where('role', 'user')->count(),
            'admins' => User::where('role', 'admin')->count(),
            'products' => Menu::count(),
            'orders' => Order::count(),
            'revenue' => Order::where('status', 'COMPLETED')->sum('total_price'),
            'orders_status' => [
                'pending' => Order::where('status', 'PENDING')->count(),
                'processing' => Order::where('status', 'PROCESSING')->count(),
                'completed' => Order::where('status', 'COMPLETED')->count(),
                'cancelled' => Order::where('status', 'CANCELLED')->count(),
            ]
        ]);
    }
}
