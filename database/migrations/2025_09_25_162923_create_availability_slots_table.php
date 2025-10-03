<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('availability_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('accommodation_id')->constrained('accommodations')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            // status values: available, reserved, blocked
            $table->string('status', 20)->default('available')->index();
            $table->timestamps();
            $table->unique(['accommodation_id', 'start_date', 'end_date']);
            $table->index(['accommodation_id', 'start_date']);
            // composite for filtering by status within an accommodation
            $table->index(['accommodation_id', 'status']);
            // enforce non-empty range (end_date inclusive logic can be adjusted in app layer)
            // Can't use $table->check() (not available in current Laravel version); will add raw constraint below.
        });

        // Add CHECK constraint ensuring start_date <= end_date
        $driver = DB::getDriverName();
        if ($driver !== 'sqlite') { // SQLite cannot add CHECK via ALTER TABLE after creation
            try {
                DB::statement('ALTER TABLE availability_slots ADD CONSTRAINT chk_availability_slots_dates CHECK (start_date <= end_date)');
            } catch (\Throwable $e) {
                // Silently ignore if unsupported (older MySQL) or already exists (during retries)
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availability_slots');
    }
};
