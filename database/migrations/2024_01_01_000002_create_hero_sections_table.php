<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->text('typed_texts')->nullable(); // JSON array for typed.js
            $table->string('heading')->nullable();
            $table->text('description')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('google_play_url')->nullable();
            $table->string('app_store_url')->nullable();
            $table->string('google_play_image')->nullable();
            $table->string('app_store_image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('active_users_text')->nullable();
            $table->string('rating_text')->nullable();
            $table->json('user_avatars')->nullable(); // JSON array of avatar images
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};

