<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name', 'price', 'category', 'image_url', 'stock', 'description'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
