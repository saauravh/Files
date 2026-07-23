<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 100)->nullable();
            $table->string('cur_text', 40)->nullable();
            $table->string('cur_sym', 40)->nullable();
            $table->string('base_color', 10)->nullable();
            $table->string('secondary_color', 10)->nullable();
            $table->tinyInteger('currency_format')->default(1);
            $table->integer('paginate_number')->default(10);
            $table->unsignedBigInteger('default_package_id')->default(0);
            $table->string('active_template', 50)->nullable();
            $table->tinyInteger('kv')->default(0)->comment('KYC Verification');
            $table->tinyInteger('ev')->default(0)->comment('Email Verification');
            $table->tinyInteger('en')->default(0)->comment('Email Notification');
            $table->tinyInteger('sv')->default(0)->comment('SMS Verification');
            $table->tinyInteger('sn')->default(0)->comment('SMS Notification');
            $table->tinyInteger('pn')->default(0)->comment('Push Notification');
            $table->tinyInteger('force_ssl')->default(0);
            $table->tinyInteger('secure_password')->default(0);
            $table->tinyInteger('registration')->default(1);
            $table->tinyInteger('agree')->default(0);
            $table->tinyInteger('multi_language')->default(0);
            $table->tinyInteger('chat_attachment')->default(0);
            $table->tinyInteger('maintenance_mode')->default(0);
            $table->string('email_from')->nullable();
            $table->string('email_from_name')->nullable();
            $table->text('email_template')->nullable();
            $table->string('sms_from')->nullable();
            $table->text('sms_template')->nullable();
            $table->string('push_title')->nullable();
            $table->text('push_template')->nullable();
            $table->json('mail_config')->nullable();
            $table->json('sms_config')->nullable();
            $table->json('global_shortcodes')->nullable();
            $table->json('socialite_credentials')->nullable();
            $table->json('firebase_config')->nullable();
            $table->json('config_progress')->nullable();
            $table->text('system_info')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
