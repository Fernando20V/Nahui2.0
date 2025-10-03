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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->foreignId('restaurant_category_id')->nullable()->constrained('restaurant_categories')->nullOnDelete();
            $table->json('cuisine_types')->nullable();
            $table->text('description')->nullable();
            $table->string('price_band', 10)->nullable();
            $table->json('hours')->nullable(); // JSON schema: {timezone, regular{mon..sun:[{open,close}]}, exceptions:[{date, open, close, closed?}]}
            // $table->json('payment_methods')->nullable(); // tabla aparte
            $table->boolean('reservations_supported')->default(false)->index();
            $table->foreignId('address_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['restaurant_category_id', 'reservations_supported']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
