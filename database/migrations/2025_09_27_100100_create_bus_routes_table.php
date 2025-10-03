<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bus_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('short_name')->nullable()->index();
            $table->string('long_name');
            // scope values: intercity, urban
            $table->string('scope', 30)->index();
            // service_pattern values: expreso, ruteado
            $table->string('service_pattern', 30)->default('ruteado')->index();
            $table->foreignId('transport_type_id')->nullable()->constrained('transport_types')->nullOnDelete();
            $table->foreignId('organization_id')->nullable()->constrained('organizations')->nullOnDelete();
            $table->foreignId('origin_stop_id')->nullable()->constrained('stops')->nullOnDelete();
            $table->foreignId('destination_stop_id')->nullable()->constrained('stops')->nullOnDelete();
            $table->foreignId('municipality_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['scope', 'service_pattern']);
            $table->index(['origin_stop_id', 'destination_stop_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bus_routes');
    }
};
