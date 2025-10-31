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
        Schema::table('download_sections', function (Blueprint $table) {
            $table->boolean('show_google_play')->default(true)->after('google_play_url');
            $table->boolean('show_app_store')->default(true)->after('app_store_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('download_sections', function (Blueprint $table) {
            $table->dropColumn(['show_google_play', 'show_app_store']);
        });
    }
};
