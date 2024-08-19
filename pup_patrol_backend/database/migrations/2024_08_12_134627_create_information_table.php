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
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('information_dog_name');
            $table->string('information_dog_character');
            $table->integer('information_min_size');
            $table->integer('information_max_size');
            $table->integer('information_min_cost');
            $table->integer('information_max_cost');
            $table->string('information_dog_text');
            $table->string('information_dog_geneticillness');
            $table->string('information_caution');
            $table->string('information_image_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
