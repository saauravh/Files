<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->json('shortcodes')->nullable();
            $table->text('email_body')->nullable();
            $table->string('email_sent_from_name')->nullable();
            $table->string('email_sent_from_address')->nullable();
            $table->tinyInteger('email_status')->default(1);
            $table->text('sms_body')->nullable();
            $table->string('sms_sent_from')->nullable();
            $table->tinyInteger('sms_status')->default(1);
            $table->string('push_title')->nullable();
            $table->text('push_body')->nullable();
            $table->tinyInteger('push_status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_templates');
    }
};
