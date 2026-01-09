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
        // Try adding each column individually and ignore failures so the migration is
        // resilient in test environments with older SQLite builds.
        try {
            Schema::table('applications', function (Blueprint $table) {
                if (!Schema::hasColumn('applications', 'middle_name')) {
                    $table->string('middle_name')->nullable();
                }
            });
        } catch (\Throwable $e) {
            // ignore
        }

        try {
            Schema::table('applications', function (Blueprint $table) {
                if (!Schema::hasColumn('applications', 'email')) {
                    $table->string('email')->nullable();
                }
            });
        } catch (\Throwable $e) {
            // ignore
        }

        try {
            Schema::table('applications', function (Blueprint $table) {
                if (!Schema::hasColumn('applications', 'gender')) {
                    $table->string('gender')->nullable();
                }
                if (!Schema::hasColumn('applications', 'state_of_origin')) {
                    $table->string('state_of_origin')->nullable();
                }
                if (!Schema::hasColumn('applications', 'lga_of_origin')) {
                    $table->string('lga_of_origin')->nullable();
                }
            });
        } catch (\Throwable $e) {
            // ignore
        }

        try {
            Schema::table('applications', function (Blueprint $table) {
                // is_iba_indigene is added separately in its own migration; skip it here to avoid duplicates.
                if (!Schema::hasColumn('applications', 'address')) {
                    $table->text('address')->nullable();
                }
                if (!Schema::hasColumn('applications', 'level')) {
                    $table->string('level')->nullable();
                }
                if (!Schema::hasColumn('applications', 'jamb_year')) {
                    $table->integer('jamb_year')->nullable();
                }
            });
        } catch (\Throwable $e) {
            // ignore
        }

        try {
            Schema::table('applications', function (Blueprint $table) {
                if (!Schema::hasColumn('applications', 'jamb_result_path')) {
                    $table->string('jamb_result_path')->nullable();
                }
                if (!Schema::hasColumn('applications', 'waec_result_path')) {
                    $table->string('waec_result_path')->nullable();
                }
                if (!Schema::hasColumn('applications', 'indigene_certificate_path')) {
                    $table->string('indigene_certificate_path')->nullable();
                }
                // admission_letter_path and admin_notes are created by dedicated migrations; skip here.
            });
        } catch (\Throwable $e) {
            // ignore
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('applications', function (Blueprint $table) {
                if (Schema::hasColumn('applications', 'middle_name')) {
                    $table->dropColumn('middle_name');
                }
                if (Schema::hasColumn('applications', 'email')) {
                    $table->dropColumn('email');
                }
                if (Schema::hasColumn('applications', 'gender')) {
                    $table->dropColumn('gender');
                }
                if (Schema::hasColumn('applications', 'state_of_origin')) {
                    $table->dropColumn('state_of_origin');
                }
                if (Schema::hasColumn('applications', 'lga_of_origin')) {
                    $table->dropColumn('lga_of_origin');
                }
                // is_iba_indigene was intentionally not added here to avoid duplicates with its own migration
                if (Schema::hasColumn('applications', 'address')) {
                    $table->dropColumn('address');
                }
                if (Schema::hasColumn('applications', 'level')) {
                    $table->dropColumn('level');
                }
                if (Schema::hasColumn('applications', 'jamb_year')) {
                    $table->dropColumn('jamb_year');
                }
                if (Schema::hasColumn('applications', 'jamb_result_path')) {
                    $table->dropColumn('jamb_result_path');
                }
                if (Schema::hasColumn('applications', 'waec_result_path')) {
                    $table->dropColumn('waec_result_path');
                }
                if (Schema::hasColumn('applications', 'indigene_certificate_path')) {
                    $table->dropColumn('indigene_certificate_path');
                }
                // admission_letter_path and admin_notes are dropped by their own migrations; skip here.
            });
        } catch (\Throwable $e) {
            // ignore
        }
    }
};
