<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'address',
        'lga',
        'town',
        'phone',
        'jamb_reg_number',
        'jamb_score',
        'institution',
        'course',
        'passport_photo',
        'id_card',
        'jamb_result',
        'status',
        'notes',
    ];

    protected $attributes = [
        'status' => 'draft',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'jamb_score' => 'decimal:2',
        'id' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adminNotes()
    {
        return $this->hasMany(AdminNote::class);
    }

    // Accessors for backward compatibility
    public function getJambResultPathAttribute()
    {
        return $this->jamb_result ?? $this->jamb_result_path;
    }

    public function getWaecResultPathAttribute()
    {
        return $this->id_card ?? $this->waec_result_path;
    }

    public function getIndigeneCertificatePathAttribute()
    {
        return $this->passport_photo ?? $this->indigene_certificate_path;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            if (empty($application->application_id)) {
                $application->application_id = 'APP-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Allowed statuses for applications
     */
    public const STATUSES = [
        'draft',
        'submitted',
        'under_review',
        'in_progress',
        'pending',
        'approved',
        'rejected',
    ];

    /**
     * Get badge classes for statuses used in admin UI
     */
    public static function statusColors(): array
    {
        return [
            'draft' => 'bg-blue-100 text-blue-800',
            'submitted' => 'bg-orange-100 text-orange-800',
            'under_review' => 'bg-indigo-100 text-indigo-800',
            'in_progress' => 'bg-yellow-100 text-yellow-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
        ];
    }

    // statuses defined
}
