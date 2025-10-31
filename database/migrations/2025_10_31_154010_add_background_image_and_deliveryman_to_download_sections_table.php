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
            $table->string('background_image')->nullable()->after('mobile_image');
        });
        
        // Note: section_type column already exists and accepts any string value
        // The constraint is handled at application level, so no migration needed for deliveryman
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('download_sections', function (Blueprint $table) {
            $table->dropColumn('background_image');
        });
    }
};
