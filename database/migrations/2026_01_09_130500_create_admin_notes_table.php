<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admin_notes')) {
            Schema::create('admin_notes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('application_id');
                $table->text('note');
                $table->boolean('is_checked')->default(false);
                $table->timestamps();

                // Foreign key to applications table
                $table->foreign('application_id')
                      ->references('id')
                      ->on('applications')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_notes');
    }
}
