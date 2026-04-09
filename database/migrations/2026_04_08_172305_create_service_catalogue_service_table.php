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
        Schema::create('service_catalogue_service', function (Blueprint $table) {
            $table->unsignedBigInteger('service_catalogue_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_catalogue_id', 'sc_id_pivot_foreign')->references('id')->on('service_catalogues')->onDelete('cascade');
            $table->foreign('service_id', 's_id_pivot_foreign')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_service_catalogue_service');
    }
};
