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
            $table->string('profile_id', 20)->nullable()->unique();
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->string('username', 100)->nullable()->unique();
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('mobile', 40)->nullable();
            $table->string('dial_code', 20)->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('zip', 20)->nullable();
            $table->string('country_name', 100)->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('ev')->default(0)->comment('Email Verified');
            $table->tinyInteger('sv')->default(0)->comment('SMS Verified');
            $table->tinyInteger('kv')->default(0)->comment('KYC Verified');
            $table->string('ver_code', 100)->nullable();
            $table->timestamp('ver_code_send_at')->nullable();
            $table->decimal('balance', 18, 8)->default(0);
            $table->tinyInteger('profile_complete')->default(0);
            $table->json('skipped_step')->nullable();
            $table->json('completed_step')->nullable();
            $table->json('kyc_data')->nullable();
            $table->string('kyc_rejection_reason')->nullable();
            $table->string('ban_reason')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index('status');
            $table->index('ev');
            $table->index('sv');
            $table->index('kv');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
