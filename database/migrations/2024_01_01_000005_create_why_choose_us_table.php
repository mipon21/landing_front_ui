<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('why_choose_us', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->string('heading');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->text('content');
            $table->string('feature_image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('why_choose_us');
    }
};

