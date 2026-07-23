<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('extensions', function (Blueprint $table) {
            if (!Schema::hasColumn('extensions', 'act')) {
                $table->string('act')->nullable()->after('id');
            }
            if (!Schema::hasColumn('extensions', 'image')) {
                $table->string('image')->nullable()->after('name');
            }
            if (!Schema::hasColumn('extensions', 'description')) {
                $table->text('description')->nullable()->after('script');
            }
            if (!Schema::hasColumn('extensions', 'support')) {
                $table->string('support')->nullable()->after('description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extensions', function (Blueprint $table) {
            //
        });
    }
};
