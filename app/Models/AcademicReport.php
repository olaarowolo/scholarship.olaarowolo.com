<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicReport extends Model
{
    protected $fillable = [
        'user_id',
        'semester',
        'level',
        'cgpa',
        'gpa',
        'courses_and_grades',
        'total_credits',
        'remarks',
        'transcript_file',
        'status',
        'admin_feedback',
    ];

    protected $casts = [
        'cgpa' => 'decimal:2',
        'gpa' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
