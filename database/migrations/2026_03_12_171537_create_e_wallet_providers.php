// database/migrations/xxxx_xx_xx_create_e_wallet_providers_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('e_wallet_providers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // ovo, gopay, dana
            $table->string('name'); // OVO, GoPay, DANA
            $table->string('icon')->nullable();
            $table->json('settings')->nullable(); // Minimal saldo, fee, dll
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('e_wallet_providers');
    }
};
