<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        // Payment Methods
        DB::table('payment_methods')->insert([
            [
                'code' => 'credit_card',
                'name' => 'Credit Card',
                'icon' => 'FaCreditCard',
                'description' => 'Pay with Visa, Mastercard, or American Express',
                'settings' => json_encode([
                    'supported_cards' => ['visa', 'mastercard', 'amex'],
                    'installment' => true,
                    'max_installment' => 12
                ]),
                'display_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'e_wallet',
                'name' => 'E-Wallet',
                'icon' => 'FaWallet',
                'description' => 'Pay with your favorite e-wallet',
                'settings' => json_encode([
                    'min_amount' => 10000,
                    'max_amount' => 2000000
                ]),
                'display_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'bank_transfer',
                'name' => 'Bank Transfer',
                'icon' => 'FaMoneyBillWave',
                'description' => 'Transfer via bank account',
                'settings' => json_encode([
                    'expiry_hours' => 24,
                    'unique_code' => true
                ]),
                'display_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // E-Wallet Providers
        DB::table('e_wallet_providers')->insert([
            [
                'code' => 'ovo',
                'name' => 'OVO',
                'icon' => 'FaMoneyBillWave',
                'settings' => json_encode(['fee' => 0, 'min_balance' => 0]),
                'display_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'gopay',
                'name' => 'GoPay',
                'icon' => 'FaMoneyBillWave',
                'settings' => json_encode(['fee' => 0, 'min_balance' => 0]),
                'display_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'dana',
                'name' => 'DANA',
                'icon' => 'FaMoneyBillWave',
                'settings' => json_encode(['fee' => 0, 'min_balance' => 0]),
                'display_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Banks
        DB::table('banks')->insert([
            [
                'code' => 'bca',
                'name' => 'BCA',
                'icon' => 'SiBca',
                'accounts' => json_encode([
                    ['account_number' => '1234567890', 'account_name' => 'PT Velveta Coffee', 'branch' => 'KCU Sudirman']
                ]),
                'settings' => json_encode(['fee' => 6500, 'min_transfer' => 10000]),
                'display_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'mandiri',
                'name' => 'Mandiri',
                'icon' => 'SiMandiri',
                'accounts' => json_encode([
                    ['account_number' => '0987654321', 'account_name' => 'PT Velveta Coffee', 'branch' => 'KCU Thamrin']
                ]),
                'settings' => json_encode(['fee' => 7500, 'min_transfer' => 10000]),
                'display_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'bni',
                'name' => 'BNI',
                'icon' => 'SiBni',
                'accounts' => json_encode([
                    ['account_number' => '1122334455', 'account_name' => 'PT Velveta Coffee', 'branch' => 'KCU Gatot Subroto']
                ]),
                'settings' => json_encode(['fee' => 5000, 'min_transfer' => 10000]),
                'display_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'code' => 'bri',
                'name' => 'BRI',
                'icon' => 'SiBri',
                'accounts' => json_encode([
                    ['account_number' => '5544332211', 'account_name' => 'PT Velveta Coffee', 'branch' => 'KCU Rasuna Said']
                ]),
                'settings' => json_encode(['fee' => 4500, 'min_transfer' => 10000]),
                'display_order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
