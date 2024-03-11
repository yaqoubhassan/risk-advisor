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
        Schema::create('consumers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->enum('contact_preference', ['email', 'sms'])->default('email');
            $table->string('street_address')->nullable();
            $table->string('apartment')->nullable();
            $table->string('city', 70);
            $table->string('state', 40);
            $table->string('zip_code', 15);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumers');
    }
};
