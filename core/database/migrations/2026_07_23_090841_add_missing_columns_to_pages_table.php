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
        Schema::table('pages', function (Blueprint $table) {
            if (!Schema::hasColumn('pages', 'tempname')) {
                $table->string('tempname')->nullable()->after('id');
            }
            if (!Schema::hasColumn('pages', 'name')) {
                $table->string('name')->nullable()->after('tempname');
            }
            if (!Schema::hasColumn('pages', 'is_default')) {
                $table->boolean('is_default')->default(0)->after('slug');
            }
            if (!Schema::hasColumn('pages', 'secs')) {
                $table->json('secs')->nullable()->after('is_default');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
};
