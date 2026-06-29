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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id('coupon_id');
            $table->string('coupon_name')->unique();
            $table->string('coupon_code')->unique();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount', 10, 2);
            $table->date('expiry_date');
            $table->decimal('max_discount', 10, 2)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
