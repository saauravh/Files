<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_logins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('user_ip', 45)->nullable();
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->string('longitude', 100)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('country', 100)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_logins');
    }
};
