<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('frontends', function (Blueprint $table) {
            $table->id();
            $table->string('data_keys')->nullable();
            $table->json('data_values')->nullable();
            $table->json('seo_content')->nullable();
            $table->string('tempname', 100)->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->index('data_keys');
            $table->index('tempname');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('frontends');
    }
};
