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
        Schema::table('hero_sections', function (Blueprint $table) {
            $table->boolean('show_search_section')->default(false)->after('description');
            $table->string('search_section_placeholder')->nullable()->after('show_search_section');
            $table->string('search_section_locate_button_text')->nullable()->after('search_section_placeholder');
            $table->string('search_section_button_text')->nullable()->after('search_section_locate_button_text');
            $table->string('search_section_button_url')->nullable()->after('search_section_button_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            $table->dropColumn([
                'show_search_section',
                'search_section_placeholder',
                'search_section_locate_button_text',
                'search_section_button_text',
                'search_section_button_url',
            ]);
        });
    }
};
