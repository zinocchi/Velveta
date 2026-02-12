<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'menu_id', 'qty', 'price'];

    public function order()
    {
        return $this->belongsTo(Menu::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
