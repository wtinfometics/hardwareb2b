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
        Schema::create('attributevariations', function (Blueprint $table) {
            $table->id('attribute_variation_id');
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('attribute_id')->references('attribute_id')->on('attributes');
            $table->string('attribute_variation_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributevariations');
    }
};
