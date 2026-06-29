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
        Schema::create('orderproducts', function (Blueprint $table) {
            $table->id('order_product_id');

            $table->foreignId('order_id')
                ->constrained('orders', 'order_id')
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->constrained('products', 'product_id');

            $table->foreignId('product_variation_id')
                ->constrained('productvariations', 'product_variation_id');

            $table->integer('quantity');

            // price at purchase time
            $table->decimal('price', 10, 2);

            // total = quantity * price
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderproducts');
    }
};
