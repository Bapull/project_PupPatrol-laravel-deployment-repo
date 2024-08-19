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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->integer('answer_is_big');
            $table->integer('answer_is_fluff');
            $table->integer('answer_is_walking');
            $table->integer('answer_is_smart');
            $table->integer('answer_is_shyness');
            $table->integer('answer_is_biting');
            $table->integer('answer_is_nuisance');
            $table->integer('answer_is_independent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
