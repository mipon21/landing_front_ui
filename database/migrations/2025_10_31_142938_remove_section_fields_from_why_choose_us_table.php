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
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->dropColumn(['badge_text', 'heading', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('why_choose_us', function (Blueprint $table) {
            $table->string('badge_text')->nullable()->after('id');
            $table->string('heading')->after('badge_text');
            $table->text('description')->nullable()->after('heading');
        });
    }
};
