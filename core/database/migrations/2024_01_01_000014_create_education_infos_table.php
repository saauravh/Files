<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('institute')->nullable();
            $table->string('degree')->nullable();
            $table->string('field_of_study')->nullable();
            $table->integer('reg_no')->nullable();
            $table->integer('roll_no')->nullable();
            $table->integer('start')->nullable();
            $table->integer('end')->nullable();
            $table->decimal('result', 8, 2)->nullable();
            $table->decimal('out_of', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_infos');
    }
};
