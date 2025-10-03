<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('organization_route', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('organization_id')->constrained('organizations')->cascadeOnDelete();
            $table->foreignId('route_id')->constrained('bus_routes')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['organization_id', 'route_id']);
            $table->index('route_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_route');
    }
};
