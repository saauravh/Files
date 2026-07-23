<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partner_expectations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('general_requirement')->nullable();
            $table->string('country')->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->decimal('min_height', 5, 2)->nullable();
            $table->decimal('max_height', 5, 2)->nullable();
            $table->decimal('max_weight', 5, 2)->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('complexion')->nullable();
            $table->tinyInteger('smoking_status')->default(0);
            $table->tinyInteger('drinking_status')->default(0);
            $table->json('language')->nullable();
            $table->string('min_degree', 40)->nullable();
            $table->string('personality', 40)->nullable();
            $table->string('profession', 40)->nullable();
            $table->string('financial_condition', 40)->nullable();
            $table->string('family_position', 40)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_expectations');
    }
};
