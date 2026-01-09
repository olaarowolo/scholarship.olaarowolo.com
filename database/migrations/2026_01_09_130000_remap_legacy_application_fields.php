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
        // Add new columns if they do not exist, then remap legacy data into them.
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'home_address')) {
                $table->text('home_address')->nullable();
            }
            if (!Schema::hasColumn('applications', 'lga_of_origin')) {
                $table->string('lga_of_origin')->nullable();
            }
            if (!Schema::hasColumn('applications', 'jamb_result_path')) {
                $table->string('jamb_result_path')->nullable();
            }
            if (!Schema::hasColumn('applications', 'waec_result_path')) {
                $table->string('waec_result_path')->nullable();
            }
            if (!Schema::hasColumn('applications', 'indigene_certificate_path')) {
                $table->string('indigene_certificate_path')->nullable();
            }
            if (!Schema::hasColumn('applications', 'admission_letter_path')) {
                $table->string('admission_letter_path')->nullable();
            }
            if (!Schema::hasColumn('applications', 'admin_notes')) {
                $table->text('admin_notes')->nullable();
            }
        });

        // Copy legacy data into the new columns in a single transaction. Use COALESCE to preserve existing values.
        DB::transaction(function () {
            // address -> home_address
            if (Schema::hasColumn('applications', 'address')) {
                DB::statement('UPDATE applications SET home_address = COALESCE(home_address, address) WHERE home_address IS NULL OR home_address = ""');
            }

            // lga -> lga_of_origin
            if (Schema::hasColumn('applications', 'lga')) {
                DB::statement('UPDATE applications SET lga_of_origin = COALESCE(lga_of_origin, lga) WHERE lga_of_origin IS NULL OR lga_of_origin = ""');
            }

            // jamb_result -> jamb_result_path
            if (Schema::hasColumn('applications', 'jamb_result')) {
                DB::statement('UPDATE applications SET jamb_result_path = COALESCE(jamb_result_path, jamb_result) WHERE jamb_result_path IS NULL OR jamb_result_path = ""');
            }

            // id_card -> waec_result_path
            if (Schema::hasColumn('applications', 'id_card')) {
                DB::statement('UPDATE applications SET waec_result_path = COALESCE(waec_result_path, id_card) WHERE waec_result_path IS NULL OR waec_result_path = ""');
            }

            // passport_photo -> indigene_certificate_path
            if (Schema::hasColumn('applications', 'passport_photo')) {
                DB::statement('UPDATE applications SET indigene_certificate_path = COALESCE(indigene_certificate_path, passport_photo) WHERE indigene_certificate_path IS NULL OR indigene_certificate_path = ""');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (Schema::hasColumn('applications', 'home_address')) {
                $table->dropColumn('home_address');
            }
            if (Schema::hasColumn('applications', 'lga_of_origin')) {
                $table->dropColumn('lga_of_origin');
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
            if (Schema::hasColumn('applications', 'admission_letter_path')) {
                $table->dropColumn('admission_letter_path');
            }
            if (Schema::hasColumn('applications', 'admin_notes')) {
                $table->dropColumn('admin_notes');
            }
        });
    }
};
