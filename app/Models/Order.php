<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method',
        'delivery_type',
        'shipping_cost',
        'shipping_address',
        'delivery_option',
        'estimated_minutes',
        'paid_at'
    ];

    protected $casts = [
        'shipping_address' => 'array',
        'delivery_option' => 'array',
        'paid_at' => 'datetime',
    ];


    protected $attributes = [
        'status' => 'PENDING',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === 'PENDING';
    }

    public function isProcessing()
    {
        return $this->status === 'PROCESSING';
    }

    public function isCompleted()
    {
        return $this->status === 'COMPLETED';
    }

    public function isCancelled()
    {
        return $this->status === 'CANCELLED';
    }

    public function isDelivery()
    {
        return $this->delivery_type === 'delivery';
    }

    public function isPickup()
    {
        return $this->delivery_type === 'pickup';
    }
}
