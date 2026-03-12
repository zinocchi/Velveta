<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $fillable = [
        'code',
        'name',
        'icon',
        'description',
        'settings',
        'display_order',
        'is_active'
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
        'display_order' => 'integer'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_method', 'code');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
