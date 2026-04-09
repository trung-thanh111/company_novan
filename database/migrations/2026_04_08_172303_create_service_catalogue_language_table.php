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
        Schema::create('service_catalogue_language', function (Blueprint $table) {
            $table->unsignedBigInteger('service_catalogue_id');
            $table->unsignedBigInteger('language_id');
            $table->foreign('service_catalogue_id', 'sc_id_foreign')->references('id')->on('service_catalogues')->onDelete('cascade');
            $table->foreign('language_id', 'language_catalogue_id_foreign')->references('id')->on('languages')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_service_catalogue_language');
    }
};
