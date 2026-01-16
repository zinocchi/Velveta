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

            $table->string('fullname');
            $table->string('username')->nullable();
            $table->string('email')->unique();

            // password boleh null kalau Google login
            $table->string('password')->nullable();

            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
