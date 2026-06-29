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
        Schema::create('productvariationimages', function (Blueprint $table) {
            $table->id('product_variation_image_id');
            $table->unsignedBigInteger('product_variation_id');
            $table->foreign('product_variation_id')->references('product_variation_id')->on('productvariations');
            $table->string('product_variation_image_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productvariationimages');
    }
};
