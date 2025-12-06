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
            Schema::create('users_temp', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->enum('role', ['admin', 'review_team', 'applicant', 'verified_beneficiary', 'user', 'scholar'])->default('applicant');
                $table->boolean('terms_accepted')->default(false);
                $table->string('device')->nullable();
                $table->string('location')->nullable();
                $table->text('credentials')->nullable();
                $table->boolean('is_iba_indigene')->default(false);
            });

            // Copy data from old table to new table
            DB::statement('INSERT INTO users_temp (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role, terms_accepted, device, location, credentials, is_iba_indigene)
                          SELECT id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role, terms_accepted, device, location, credentials, is_iba_indigene FROM users');

            // Drop old table
            Schema::drop('users');

            // Rename temp table to users
            Schema::rename('users_temp', 'users');
        } else {
            // For MySQL/PostgreSQL
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'review_team', 'applicant', 'verified_beneficiary', 'user', 'scholar') DEFAULT 'applicant'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // For SQLite, recreate table with old enum values
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::create('users_temp', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                $table->enum('role', ['admin', 'review_team', 'applicant', 'verified_beneficiary', 'user'])->default('applicant');
                $table->boolean('terms_accepted')->default(false);
                $table->string('device')->nullable();
                $table->string('location')->nullable();
                $table->text('credentials')->nullable();
                $table->boolean('is_iba_indigene')->default(false);
            });

            DB::statement('INSERT INTO users_temp (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role, terms_accepted, device, location, credentials, is_iba_indigene)
                          SELECT id, name, email, email_verified_at, password, remember_token, created_at, updated_at, role, terms_accepted, device, location, credentials, is_iba_indigene FROM users WHERE role != "scholar"');

            Schema::drop('users');
            Schema::rename('users_temp', 'users');
        } else {
            // For MySQL/PostgreSQL
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'review_team', 'applicant', 'verified_beneficiary', 'user') DEFAULT 'applicant'");
        }
    }
};
