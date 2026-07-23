<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gateway_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('gateway_alias', 100)->nullable();
            $table->string('currency', 20)->nullable();
            $table->string('symbol', 20)->nullable();
            $table->integer('method_code');
            $table->decimal('min_amount', 18, 8)->default(0);
            $table->decimal('max_amount', 18, 8)->default(0);
            $table->decimal('fixed_charge', 18, 8)->default(0);
            $table->decimal('percent_charge', 8, 2)->default(0);
            $table->decimal('rate', 18, 8)->default(1);
            $table->json('gateway_parameter')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('image')->nullable();
            $table->timestamps();

            $table->index('method_code');
            $table->index('currency');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gateway_currencies');
    }
};
