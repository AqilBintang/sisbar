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
        Schema::table('bookings', function (Blueprint $table) {
            // Add indexes for frequently queried columns
            $table->index('created_at', 'bookings_created_at_index');
            $table->index('payment_status', 'bookings_payment_status_index');
            $table->index('status', 'bookings_status_index');
            $table->index('booking_date', 'bookings_booking_date_index');
            
            // Composite indexes for common query combinations
            $table->index(['created_at', 'payment_status'], 'bookings_created_payment_index');
            $table->index(['status', 'payment_status'], 'bookings_status_payment_index');
            $table->index(['barber_id', 'booking_date'], 'bookings_barber_date_index');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index('is_active', 'services_is_active_index');
            $table->index('type', 'services_type_index');
        });

        Schema::table('barbers', function (Blueprint $table) {
            $table->index('is_active', 'barbers_is_active_index');
            $table->index('level', 'barbers_level_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex('bookings_created_at_index');
            $table->dropIndex('bookings_payment_status_index');
            $table->dropIndex('bookings_status_index');
            $table->dropIndex('bookings_booking_date_index');
            $table->dropIndex('bookings_created_payment_index');
            $table->dropIndex('bookings_status_payment_index');
            $table->dropIndex('bookings_barber_date_index');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex('services_is_active_index');
            $table->dropIndex('services_type_index');
        });

        Schema::table('barbers', function (Blueprint $table) {
            $table->dropIndex('barbers_is_active_index');
            $table->dropIndex('barbers_level_index');
        });
    }
};