<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'menu_id',
        'qty',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'qty' => 'integer'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->price * $this->qty;
    }
}
