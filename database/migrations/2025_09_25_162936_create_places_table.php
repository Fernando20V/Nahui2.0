<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->foreignId('place_category_id')->nullable()->constrained('place_categories')->nullOnDelete();
            $table->json('imagenes')->nullable();
            $table->string('coordenadas')->nullable();
            $table->decimal('latitude', 17, 14)->nullable();
            $table->decimal('longitude', 17, 14)->nullable();
            $table->text('description')->nullable();
            $table->string('servicios')->nullable();
            $table->unsignedInteger('habitaciones')->nullable();
            $table->unsignedInteger('capacidad')->nullable();
            $table->text('reglas')->nullable();
            $table->string('promocion')->nullable();
            $table->foreignId('address_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_public')->default(true)->index();
            $table->boolean('is_managed')->default(false)->index();
            $table->foreignId('managing_org_id')->nullable()->constrained('organizations')->nullOnDelete();
            $table->json('hours')->nullable();
            $table->text('accessibility_notes')->nullable();
            $table->decimal('entrance_fee', 10, 2)->nullable();
            $table->char('currency', 3)->default('USD');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['place_category_id', 'is_public']);

$table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
$table->foreignId('municipality_id')->nullable()->constrained()->nullOnDelete();
            $table->index(['address_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
