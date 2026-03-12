// database/migrations/xxxx_xx_xx_create_banks_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // bca, mandiri, bni, bri
            $table->string('name'); // BCA, Mandiri, BNI, BRI
            $table->string('icon')->nullable();
            $table->json('accounts')->nullable(); // Rekening perusahaan
            $table->json('settings')->nullable(); // Fee, minimal transfer, dll
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banks');
    }
};
