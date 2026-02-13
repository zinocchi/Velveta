<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        return response()->json(
            $request->user()->orders()
                ->with('items.menu')
                ->latest()
                ->get()
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['id']);
                $total += $menu->price * $item['qty'];
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $item['qty'],
                    'price' => $menu->price,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Order created',
                'order_id' => $order->id
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Failed to create order',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    public function pay(Request $request, Order $order)
    {
        abort_if($order->user_id !== $request->user()->id, 403);
        abort_if($order->status !== 'pending', 400, 'Order already paid');

        $order->update([
            'status' => 'preparing',
            'paid_at' => now(),
            'estimated_minutes' => rand(5, 15),
        ]);

        return response()->json([
            'message' => 'Payment success'
        ]);
    }
}
