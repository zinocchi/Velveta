<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // STEP 1: Create table dulu
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['PROCESSING', 'COMPLETED', 'CANCELLED'])->default('PROCESSING');
            $table->string('payment_method');
            $table->enum('delivery_type', ['delivery', 'pickup']);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->json('shipping_address')->nullable();
            $table->json('delivery_option')->nullable();
            $table->integer('estimated_minutes')->nullable();
            $table->string('order_number', 10)->unique();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        // STEP 2: Tambah kolom dengan AFTER
        Schema::table('orders', function (Blueprint $table) {
            $table->json('payment_details')->nullable()->after('payment_method');
            $table->string('e_wallet_provider')->nullable()->after('payment_details');
            $table->string('bank_code')->nullable()->after('e_wallet_provider');
            $table->string('card_last4', 4)->nullable()->after('bank_code');

            // Index untuk performa
            $table->index('e_wallet_provider');
            $table->index('bank_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
