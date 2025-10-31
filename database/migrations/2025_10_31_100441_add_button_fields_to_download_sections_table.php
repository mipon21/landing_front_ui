<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('download_sections', function (Blueprint $table) {
            $table->string('button_text')->nullable()->after('app_store_url');
            $table->string('button_url')->nullable()->after('button_text');
        });
    }

    public function down(): void
    {
        Schema::table('download_sections', function (Blueprint $table) {
            $table->dropColumn(['button_text', 'button_url']);
        });
    }
};
