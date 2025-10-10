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
        Schema::create('car_rentals', function (Blueprint $table) {
            $table->id();

            // When the rental starts
            $table->dateTime('rental_date');

            // Where the car will be dropped off
            $table->string('dropoff_location');

            $table->decimal('total_cost', 10, 2);

            // Keep status flexible but constrained by application logic; index for filtering
            $table->string('status', 32)->default('pending')->index();

            // Payment method label (e.g., cash, card, transfer). Nullable until payment is chosen
            $table->string('payment_method', 32)->nullable();

            // Duration in hours (adjust in code if using different unit)
            $table->unsignedInteger('rental_duration');

            $table->string('car_model');

            // Longer free-text; optional
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_rentals');
    }
};
