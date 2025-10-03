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
        Schema::create('buses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transport_status', 20);
            $table->string('departure_time');
            $table->string('waiting_location');
            $table->string('transport_type');
            $table->string('organization_id');
            $table->string('ticket_price');
            $table->string('travel_duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
