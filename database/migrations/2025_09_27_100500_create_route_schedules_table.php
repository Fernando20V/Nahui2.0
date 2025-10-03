<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('route_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('route_id')->constrained('bus_routes')->cascadeOnDelete();
            $table->unsignedTinyInteger('days_mask')->default(127); // 1 bit per day (Mon=1<<0 .. Sun=1<<6)
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->unsignedSmallInteger('headway_minutes')->nullable();
            $table->timestamps();
            $table->index(['route_id', 'days_mask']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_schedules');
    }
};
