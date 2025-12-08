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
        Schema::create('academic_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('semester'); // e.g., "First Semester 2024/2025"
            $table->string('level'); // 100, 200, 300, 400, 500
            $table->decimal('cgpa', 3, 2)->nullable(); // e.g., 4.50
            $table->decimal('gpa', 3, 2)->nullable(); // current semester GPA
            $table->text('courses_and_grades')->nullable(); // JSON or text field
            $table->integer('total_credits')->nullable();
            $table->text('remarks')->nullable();
            $table->string('transcript_file')->nullable(); // path to uploaded file
            $table->enum('status', ['submitted', 'reviewed', 'flagged'])->default('submitted');
            $table->text('admin_feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_reports');
    }
};
