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
            // Add payment_method column
            $table->enum('payment_method', ['cash', 'online'])->default('cash');
            
            // Add payment_status column
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'challenge'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the added columns
            $table->dropColumn(['payment_method', 'payment_status']);
        });
    }
};
