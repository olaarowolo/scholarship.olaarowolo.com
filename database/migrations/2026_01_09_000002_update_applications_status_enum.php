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
        // For SQLite, recreate the table with the new enum values
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::create('applications_temp', function (Blueprint $table) {
                $table->id();
                $table->string('application_id')->unique();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('middle_name')->nullable();
                $table->string('email')->nullable();
                // Legacy columns preserved for backward compatibility with older code/tests
                $table->text('address')->nullable();
                $table->string('lga')->nullable();
                $table->string('town')->nullable();
                $table->string('passport_photo')->nullable();
                $table->string('id_card')->nullable();
                $table->string('jamb_result')->nullable();
                $table->string('phone')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('gender')->nullable();
                $table->string('state_of_origin')->nullable();
                $table->string('lga_of_origin')->nullable();
                $table->boolean('is_iba_indigene')->default(false);
                // 'address' already defined above as legacy column; do not duplicate
                $table->string('institution')->nullable();
                $table->string('course')->nullable();
                $table->string('level')->nullable();
                $table->string('jamb_reg_number')->nullable();
                $table->decimal('jamb_score', 5, 2)->nullable();
                $table->integer('jamb_year')->nullable();
                $table->string('jamb_result_path')->nullable();
                $table->string('waec_result_path')->nullable();
                $table->string('indigene_certificate_path')->nullable();
                $table->enum('status', ['draft', 'submitted', 'under_review', 'in_progress', 'pending', 'approved', 'rejected'])->default('draft');
                $table->text('notes')->nullable();
                // admin_notes and admission_letter_path are added by separate migrations
                $table->timestamps();
            });

            // Build a resilient SELECT list that uses NULL for any missing columns
            $desiredColumns = [
                'id', 'application_id', 'user_id', 'first_name', 'last_name', 'middle_name', 'email', 'address', 'lga', 'town', 'passport_photo', 'id_card', 'jamb_result', 'phone', 'date_of_birth', 'gender', 'state_of_origin', 'lga_of_origin', 'is_iba_indigene', 'institution', 'course', 'level', 'jamb_reg_number', 'jamb_score', 'jamb_year', 'jamb_result_path', 'waec_result_path', 'indigene_certificate_path', 'status', 'notes', 'created_at', 'updated_at',
            ];

            $selectParts = array_map(function ($col) {
                return Schema::hasColumn('applications', $col) ? $col : ('NULL AS ' . $col);
            }, $desiredColumns);

            $columns = implode(', ', $selectParts);

            DB::statement("INSERT INTO applications_temp (id, application_id, user_id, first_name, last_name, middle_name, email, address, lga, town, passport_photo, id_card, jamb_result, phone, date_of_birth, gender, state_of_origin, lga_of_origin, is_iba_indigene, institution, course, level, jamb_reg_number, jamb_score, jamb_year, jamb_result_path, waec_result_path, indigene_certificate_path, status, notes, created_at, updated_at)\n                SELECT $columns FROM applications");

            Schema::drop('applications');
            Schema::rename('applications_temp', 'applications');
        } else {
            // For MySQL/PostgreSQL
            DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('draft','submitted','under_review','in_progress','pending','approved','rejected') DEFAULT 'draft'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::create('applications_temp', function (Blueprint $table) {
                $table->id();
                $table->string('application_id')->unique();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('middle_name')->nullable();
                $table->string('email')->nullable();
                // Legacy columns preserved for backward compatibility with older code/tests
                $table->text('address')->nullable();
                $table->string('lga')->nullable();
                $table->string('town')->nullable();
                $table->string('passport_photo')->nullable();
                $table->string('id_card')->nullable();
                $table->string('jamb_result')->nullable();
                $table->string('phone')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('gender')->nullable();
                $table->string('state_of_origin')->nullable();
                $table->string('lga_of_origin')->nullable();
                $table->boolean('is_iba_indigene')->default(false);
                // 'address' already defined above as legacy column; do not duplicate
                $table->string('institution')->nullable();
                $table->string('course')->nullable();
                $table->string('level')->nullable();
                $table->string('jamb_reg_number')->nullable();
                $table->decimal('jamb_score', 5, 2)->nullable();
                $table->integer('jamb_year')->nullable();
                $table->string('jamb_result_path')->nullable();
                $table->string('waec_result_path')->nullable();
                $table->string('indigene_certificate_path')->nullable();
                $table->enum('status', ['draft', 'submitted', 'pending', 'approved', 'rejected'])->default('draft');
                $table->text('notes')->nullable();
                // admin_notes and admission_letter_path are added by separate migrations
                $table->timestamps();
            });

            // Build a resilient SELECT list that uses NULL for any missing columns
            $desiredColumns = [
                'id', 'application_id', 'user_id', 'first_name', 'last_name', 'middle_name', 'email', 'address', 'lga', 'town', 'passport_photo', 'id_card', 'jamb_result', 'phone', 'date_of_birth', 'gender', 'state_of_origin', 'lga_of_origin', 'is_iba_indigene', 'institution', 'course', 'level', 'jamb_reg_number', 'jamb_score', 'jamb_year', 'jamb_result_path', 'waec_result_path', 'indigene_certificate_path', 'status', 'notes', 'created_at', 'updated_at',
            ];

            $selectParts = array_map(function ($col) {
                return Schema::hasColumn('applications', $col) ? $col : ('NULL AS ' . $col);
            }, $desiredColumns);

            $columns = implode(', ', $selectParts);

            DB::statement("INSERT INTO applications_temp (id, application_id, user_id, first_name, last_name, middle_name, email, address, lga, town, passport_photo, id_card, jamb_result, phone, date_of_birth, gender, state_of_origin, lga_of_origin, is_iba_indigene, institution, course, level, jamb_reg_number, jamb_score, jamb_year, jamb_result_path, waec_result_path, indigene_certificate_path, status, notes, created_at, updated_at)\n                SELECT $columns FROM applications WHERE status NOT IN (\"under_review\", \"in_progress\")");

            Schema::drop('applications');
            Schema::rename('applications_temp', 'applications');
        } else {
            DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('draft','submitted','pending','approved','rejected') DEFAULT 'draft'");
        }
    }
};
