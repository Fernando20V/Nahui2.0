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
            // canonical reference to Place (holds name, address, description, hours, coords)
            $table->foreignId('place_id')->constrained('places')->cascadeOnDelete()->unique()->index();
            $table->foreignId('restaurant_category_id')->nullable()->constrained('restaurant_categories')->nullOnDelete();
            $table->json('cuisine_types')->nullable();
            $table->string('price_band', 10)->nullable();
            // $table->json('payment_methods')->nullable();
            // boolean for card payments
            $table->boolean('reservations_supported')->default(false)->index();
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
