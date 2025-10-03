<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_days', function (Blueprint $table) {
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('accommodation_id')->constrained('accommodations')->cascadeOnDelete();
            $table->date('day'); // represents an occupied night (arrival day included, checkout day excluded)
            $table->primary(['booking_id', 'day']);
            $table->unique(['accommodation_id', 'day']); // prevents double booking for the same accommodation + day
            $table->index(['accommodation_id', 'day']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_days');
    }
};
