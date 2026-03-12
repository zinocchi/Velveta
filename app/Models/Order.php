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
        'payment_details', // Tambah
        'delivery_type',
        'shipping_cost',
        'shipping_address',
        'delivery_option',
        'estimated_minutes',
        'order_number',
        'paid_at',
        'e_wallet_provider', // Tambah
        'bank_code', // Tambah
        'card_last4' // Tambah
    ];

    protected $casts = [
        'shipping_address' => 'array',
        'delivery_option' => 'array',
        'payment_details' => 'array', // Tambah
        'paid_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'PROCESSING', // Sesuai migration: default PROCESSING
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke payment methods
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method', 'code');
    }

    public function eWalletProvider()
    {
        return $this->belongsTo(EWalletProvider::class, 'e_wallet_provider', 'code');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_code', 'code');
    }

    // Status checks
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

    // Delivery type checks
    public function isDelivery()
    {
        return $this->delivery_type === 'delivery';
    }

    public function isPickup()
    {
        return $this->delivery_type === 'pickup';
    }

    // Payment info helpers
    public function getPaymentMethodName()
    {
        $methods = [
            'credit_card' => 'Credit Card',
            'e_wallet' => 'E-Wallet',
            'bank_transfer' => 'Bank Transfer',
            'cash' => 'Cash on Delivery'
        ];

        return $methods[$this->payment_method] ?? ucfirst(str_replace('_', ' ', $this->payment_method));
    }

    public function getPaymentIcon()
    {
        $icons = [
            'credit_card' => 'FaCreditCard',
            'e_wallet' => 'FaWallet',
            'bank_transfer' => 'FaMoneyBillWave',
            'cash' => 'FaMoneyBillWave'
        ];

        return $icons[$this->payment_method] ?? 'FaCreditCard';
    }
}
