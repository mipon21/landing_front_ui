<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('how_it_works', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->string('heading');
            $table->text('description')->nullable();
            $table->string('step_image');
            $table->string('step_title');
            $table->text('step_description');
            $table->integer('step_number');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('how_it_works');
    }
};

