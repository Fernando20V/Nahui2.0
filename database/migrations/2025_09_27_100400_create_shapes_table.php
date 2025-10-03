<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shapes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('route_id')->constrained('bus_routes')->cascadeOnDelete();
            $table->geometry('path'); // TODO: this method supports srid
            $table->decimal('length_km', 8, 2)->nullable();
            $table->boolean('is_primary')->default(true)->index();
            $table->timestamps();
            $table->index(['route_id', 'is_primary']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shapes');
    }
};
