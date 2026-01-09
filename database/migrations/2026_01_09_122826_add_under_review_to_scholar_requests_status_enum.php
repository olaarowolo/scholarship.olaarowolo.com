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
        // For SQLite, we need to recreate the table with the new enum values
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            // Create temporary table with new schema
            Schema::create('scholar_requests_temp', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('request_type'); // assistance, resources, support
                $table->string('subject');
                $table->text('description');
                $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
                $table->enum('status', ['pending', 'under_review', 'in_progress', 'resolved', 'closed', 'rejected'])->default('pending');
                $table->text('admin_notes')->nullable();
                $table->timestamps();
            });

            // Copy data from old table to new table
            DB::statement('INSERT INTO scholar_requests_temp (id, user_id, request_type, subject, description, priority, status, admin_notes, created_at, updated_at)
                          SELECT id, user_id, request_type, subject, description, priority, status, admin_notes, created_at, updated_at FROM scholar_requests');

            // Drop old table
            Schema::drop('scholar_requests');

            // Rename temp table to scholar_requests
            Schema::rename('scholar_requests_temp', 'scholar_requests');
        } else {
            // For MySQL/PostgreSQL
            DB::statement("ALTER TABLE scholar_requests MODIFY COLUMN status ENUM('pending', 'under_review', 'in_progress', 'resolved', 'closed', 'rejected') DEFAULT 'pending'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // For SQLite, recreate table with old enum values
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::create('scholar_requests_temp', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('request_type'); // assistance, resources, support
                $table->string('subject');
                $table->text('description');
                $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
                $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed', 'rejected'])->default('pending');
                $table->text('admin_notes')->nullable();
                $table->timestamps();
            });

            DB::statement('INSERT INTO scholar_requests_temp (id, user_id, request_type, subject, description, priority, status, admin_notes, created_at, updated_at)
                          SELECT id, user_id, request_type, subject, description, priority, status, admin_notes, created_at, updated_at FROM scholar_requests WHERE status != "under_review"');

            Schema::drop('scholar_requests');
            Schema::rename('scholar_requests_temp', 'scholar_requests');
        } else {
            // For MySQL/PostgreSQL
            DB::statement("ALTER TABLE scholar_requests MODIFY COLUMN status ENUM('pending', 'in_progress', 'resolved', 'closed', 'rejected') DEFAULT 'pending'");
        }
    }
};
