<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->foreignId('municipality_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('address_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('place_id')->nullable()->constrained('places')->nullOnDelete();
            // To do: grimzy/laravel-mysql-spatial which adds $table->point(). However, enforcing SRID 4326 requires raw SQL
            // $table->point('location')->nullable(); // TODO: enforce SRID 4326 in a later migration
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->boolean('is_terminal')->default(false)->index();
            $table->boolean('is_active')->default(true); // covered by composite (municipality_id, is_active)
            $table->timestamps();
            $table->softDeletes();
            $table->index(['municipality_id', 'is_active']);
            $table->index(['lat', 'lng']);
            // $table->spatialIndex('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stops');
    }
};
