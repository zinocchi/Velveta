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
    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
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
                'user_id' => auth()->id(),
                'total_price' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'preparing',
                'estimated_minutes' => rand(5, 15),
                'paid_at' => now(),
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
                'message' => 'Payment success',
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
