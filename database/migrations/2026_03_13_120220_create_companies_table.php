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
        Schema::create('companies', function (Blueprint $table) {
            $table->id('company_id'); // standard primary key

            $table->string('name'); // company_name → name
            $table->string('website_name')->nullable();
            $table->string('website_url')->nullable(); // consistent snake_case
            $table->string('trn_number')->nullable(); 

            // Address fields
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pin_code')->nullable(); // pin_code → postal_code
             
            // Contact info
            $table->string('phone')->nullable(); // mobile_number → phone
            $table->string('email')->nullable()->index(); // email_id → email

            $table->string('logo')->nullable();
            $table->string('fav_icon')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
