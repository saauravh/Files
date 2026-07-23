<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('tempname')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_default')->default(0);
            $table->json('secs')->nullable();
            $table->json('seo_content')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
