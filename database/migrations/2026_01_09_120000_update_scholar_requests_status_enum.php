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
        // For SQLite, we need to recreate the table to update the enum
        Schema::rename('scholar_requests', 'scholar_requests_old');

        Schema::create('scholar_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('request_type'); // assistance, resources, support
            $table->string('subject');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });

        // Copy data from old table to new table
        DB::statement('INSERT INTO scholar_requests (id, user_id, request_type, subject, description, priority, status, admin_notes, attachments, created_at, updated_at) SELECT id, user_id, request_type, subject, description, priority, status, admin_notes, attachments, created_at, updated_at FROM scholar_requests_old');

        // Drop the old table
        Schema::drop('scholar_requests_old');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the enum back to original
        Schema::rename('scholar_requests', 'scholar_requests_old');

        Schema::create('scholar_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('request_type'); // assistance, resources, support
            $table->string('subject');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->json('attachments')->nullable();
            $table->timestamps();
        });

        // Copy data back, but filter out invalid statuses
        DB::statement("INSERT INTO scholar_requests (id, user_id, request_type, subject, description, priority, status, admin_notes, attachments, created_at, updated_at) SELECT id, user_id, request_type, subject, description, priority, CASE WHEN status IN ('pending', 'in_progress', 'resolved', 'closed') THEN status ELSE 'pending' END, admin_notes, attachments, created_at, updated_at FROM scholar_requests_old");

        Schema::drop('scholar_requests_old');
    }
};
