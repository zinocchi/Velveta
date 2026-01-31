<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;

class OrderController extends Controller
{
    public function checkout (Request $request)
    {
        $user = $request->user();

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => 0,
            'status' => 'paid',
        ]);

        $total = 0;

        foreach ($request-> item as $item) {
            $menu = Menu::findOrFail($item['id']);

            $subtotal = $menu->price * $item['qty'];
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'qty' => $item['qty'],
                'price' => $subtotal,
            ]);
        }

        $order->update(['total_price' => $total]);

        return response()->json([
            'message' => 'Order Success',
            'order_id' => $order->id,
            'total_price' => $total,
        ]);
    }
}
