<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminWorkPin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Buat 10 PIN awal
        for ($i = 1; $i <= 10; $i++) {
            $pinNumber = str_pad($i, 2, '0', STR_PAD_LEFT);
            AdminWorkPin::create([
                'work_pin' => 'VELVETA' . $pinNumber,
                'is_used' => false
            ]);
        }
    }
}
