<?php
// app/Models/Bank.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'banks';

    protected $fillable = [
        'code',
        'name',
        'icon',
        'accounts',
        'settings',
        'display_order',
        'is_active'
    ];

    protected $casts = [
        'accounts' => 'array',
        'settings' => 'array',
        'is_active' => 'boolean',
        'display_order' => 'integer'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'bank_code', 'code');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
