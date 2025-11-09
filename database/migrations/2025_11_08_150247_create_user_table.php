<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // data utama
            $table->string('fullname');
            $table->string('username')->unique();
            $table->string('email')->unique();

            // password bisa nullable karena login Google tidak pakai password
            $table->string('password')->nullable();

            // kolom untuk login Google
            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();

            // tambahan Laravel default
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
