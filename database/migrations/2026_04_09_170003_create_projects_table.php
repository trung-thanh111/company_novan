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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_catalogue_id')->default(0);
            $table->string('image')->nullable();
            $table->text('album')->nullable();
            $table->tinyInteger('publish')->default(2);
            $table->integer('order')->default(0);
            $table->unsignedBigInteger('user_id');
            
            // Generic Technical Fields
            $table->decimal('value', 15, 2)->nullable()->default(0);
            $table->string('scale')->nullable();
            $table->string('location')->nullable();
            $table->text('map')->nullable();
            $table->string('customer')->nullable();
            $table->string('status')->nullable();
            $table->text('amenities')->nullable();
            $table->string('video_url')->nullable();
            $table->string('brochure')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->json('params')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
