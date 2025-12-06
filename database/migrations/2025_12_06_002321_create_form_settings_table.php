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
        Schema::create('form_settings', function (Blueprint $table) {
            $table->id();
            $table->string('form_name')->unique(); // e.g., 'application_form', 'scholar_requests'
            $table->boolean('is_open')->default(false);
            $table->datetime('opens_at')->nullable();
            $table->datetime('closes_at')->nullable();
            $table->text('closed_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_settings');
    }
};
