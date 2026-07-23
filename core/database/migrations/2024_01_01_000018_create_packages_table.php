<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->decimal('amount', 18, 8)->default(0);
            $table->integer('interest_express_limit')->default(0);
            $table->integer('contact_view_limit')->default(0);
            $table->integer('image_upload_limit')->default(0);
            $table->integer('validity_period')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
