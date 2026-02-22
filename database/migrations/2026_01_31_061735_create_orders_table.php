<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['PENDING', 'PROCESSING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
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
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
