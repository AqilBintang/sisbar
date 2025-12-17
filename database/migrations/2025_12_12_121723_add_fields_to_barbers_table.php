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
        Schema::table('barbers', function (Blueprint $table) {
            $table->string('level')->default('professional')->after('specialty'); // junior, professional, senior, master, specialist, creative
            $table->string('schedule')->nullable()->after('rating'); // working schedule
            $table->json('skills')->nullable()->after('schedule'); // array of skills
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barbers', function (Blueprint $table) {
            $table->dropColumn(['level', 'schedule', 'skills']);
        });
    }
};
