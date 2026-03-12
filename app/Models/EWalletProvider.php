<?php
// app/Models/EWalletProvider.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EWalletProvider extends Model
{
    use HasFactory;

    protected $table = 'e_wallet_providers';

    protected $fillable = [
        'code',
        'name',
        'icon',
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
        return $this->hasMany(Order::class, 'e_wallet_provider', 'code');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
