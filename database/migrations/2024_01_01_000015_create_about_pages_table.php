<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('section_type'); // overview, statistics, about, facts
            $table->string('badge_text')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->json('features')->nullable();
            $table->json('statistics')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};

