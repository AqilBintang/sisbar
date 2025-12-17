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
        // Update enum to include sandbox_limited status
        DB::statement("ALTER TABLE broadcast_recipients MODIFY COLUMN status ENUM('pending', 'sent', 'failed', 'delivered', 'sandbox_limited') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum
        DB::statement("ALTER TABLE broadcast_recipients MODIFY COLUMN status ENUM('pending', 'sent', 'failed', 'delivered') DEFAULT 'pending'");
    }
};