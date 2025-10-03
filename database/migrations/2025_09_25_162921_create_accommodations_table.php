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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('organization_id')->nullable()->constrained('organizations')->nullOnDelete();
            $table->foreignId('address_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('accommodation_type_id')->nullable()->constrained('accommodation_types')->nullOnDelete();
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('size_sqm')->nullable();
            $table->unsignedSmallInteger('floors')->default(1);
            $table->unsignedSmallInteger('bedrooms')->default(0);
            $table->unsignedSmallInteger('bathrooms')->default(0);
            $table->boolean('cats_allowed')->default(true);
            $table->boolean('dogs_allowed')->default(true);
            $table->decimal('base_price', 10, 2)->nullable();
            $table->char('currency', 3)->nullable();
            // status values: active, inactive (stored as plain string for flexibility)
            $table->string('status', 20)->default('active')->index();
            $table->timestamp('posted_at')->nullable()->index();
            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['accommodation_type_id', 'status']);
            $table->index(['status', 'base_price']);
            // frequent listing: newest active
            $table->index(['status', 'posted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
