<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin_work_pins', function (Blueprint $table) {
            $table->id();
            $table->string('work_pin')->unique(); 
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_used')->default(false);
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_work_pins');
    }
};
