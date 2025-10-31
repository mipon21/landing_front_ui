<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('download_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->string('heading');
            $table->text('description')->nullable();
            $table->string('promo_text')->nullable();
            $table->string('google_play_url')->nullable();
            $table->string('app_store_url')->nullable();
            $table->string('left_image')->nullable();
            $table->string('right_image')->nullable();
            $table->string('mobile_image')->nullable();
            $table->string('section_type')->default('download'); // download, register
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('download_sections');
    }
};

