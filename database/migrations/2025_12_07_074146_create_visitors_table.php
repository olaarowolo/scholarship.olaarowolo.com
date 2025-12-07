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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamp('last_visit_at');
            $table->integer('visit_count')->default(1);
            $table->timestamps();

            $table->index(['ip_address', 'session_id']);
            $table->index('last_visit_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
