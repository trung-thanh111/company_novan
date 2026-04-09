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
        Schema::create('achievement_language', function (Blueprint $table) {
            $table->unsignedBigInteger('achievement_id');
            $table->unsignedBigInteger('language_id');
            $table->foreign('achievement_id', 'achievement_id_foreign')->references('id')->on('achievements')->onDelete('cascade');
            $table->foreign('language_id', 'language_achievement_id_foreign')->references('id')->on('languages')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievement_language');
    }
};
