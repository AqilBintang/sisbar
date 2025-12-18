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
        // SQLite doesn't support MODIFY COLUMN, so we'll skip this for SQLite
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE broadcast_recipients MODIFY COLUMN status ENUM('pending', 'sent', 'failed', 'delivered', 'sandbox_limited') DEFAULT 'pending'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // SQLite doesn't support MODIFY COLUMN, so we'll skip this for SQLite
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE broadcast_recipients MODIFY COLUMN status ENUM('pending', 'sent', 'failed', 'delivered') DEFAULT 'pending'");
        }
    }
};