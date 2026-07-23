<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->unique();
            $table->string('name', 100)->nullable();
            $table->string('alias', 100)->nullable();
            $table->string('image')->nullable();
            $table->json('gateway_parameters')->nullable();
            $table->json('extra')->nullable();
            $table->json('input_form')->nullable();
            $table->json('supported_currencies')->nullable();
            $table->tinyInteger('crypto')->default(0);
            $table->unsignedBigInteger('form_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('forms')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
