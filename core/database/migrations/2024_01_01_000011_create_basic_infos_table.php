<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('basic_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('gender', 10)->nullable();
            $table->string('profession')->nullable();
            $table->string('financial_condition')->nullable();
            $table->string('religion')->nullable();
            $table->tinyInteger('smoking_status')->default(0);
            $table->tinyInteger('drinking_status')->default(0);
            $table->date('birth_date')->nullable();
            $table->json('language')->nullable();
            $table->string('marital_status')->nullable();
            $table->json('present_address')->nullable();
            $table->json('permanent_address')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('basic_infos');
    }
};
