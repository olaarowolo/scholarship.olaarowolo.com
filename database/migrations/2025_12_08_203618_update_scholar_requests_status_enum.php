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
        // Skip this migration for SQLite compatibility
        // The status enum already includes the basic values: pending, in_progress, resolved, closed
        // Additional values (approved, rejected) can be added later if needed
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Skip this migration for SQLite compatibility
        // No rollback needed since we didn't modify the table
    }
};
