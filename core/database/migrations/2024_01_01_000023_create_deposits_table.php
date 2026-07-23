<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('method_code')->nullable();
            $table->string('method_currency', 20)->nullable();
            $table->decimal('amount', 18, 8)->default(0);
            $table->decimal('charge', 18, 8)->default(0);
            $table->decimal('rate', 18, 8)->default(0);
            $table->decimal('final_amount', 18, 8)->default(0);
            $table->string('trx', 100)->nullable()->unique();
            $table->unsignedBigInteger('purchase_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->json('detail')->nullable();
            $table->string('admin_feedback')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('status');
            $table->index('trx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
