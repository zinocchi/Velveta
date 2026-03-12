// database/migrations/xxxx_xx_xx_create_payment_methods_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // credit_card, e_wallet, bank_transfer
            $table->string('name'); // Credit Card, E-Wallet, Bank Transfer
            $table->string('icon')->nullable(); // Nama icon atau URL
            $table->text('description')->nullable();
            $table->json('settings')->nullable(); // Konfigurasi tambahan
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
};
