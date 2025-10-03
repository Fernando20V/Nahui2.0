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
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('accommodation_id')->constrained('accommodations')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date'); // end_date means the day they leave (exclusive)
            $table->unsignedTinyInteger('guests');
            $table->decimal('total_price', 10, 2);
            $table->char('currency', 3)->default('USD');
            // status values: confirmed, cancelled, completed
            $table->string('status', 20)->default('confirmed')->index();
            $table->timestamps();
            $table->softDeletes();
            // Will add raw CHECK constraint after creation (end_date > start_date)
            $table->index(['accommodation_id', 'start_date', 'end_date']);
            $table->index(['accommodation_id', 'status', 'start_date']);
        });

        $driver = DB::getDriverName();
        if ($driver !== 'sqlite') {
            try {
                DB::statement('ALTER TABLE bookings ADD CONSTRAINT chk_bookings_dates CHECK (end_date > start_date)');
            } catch (\Throwable $e) {
                // ignore
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
