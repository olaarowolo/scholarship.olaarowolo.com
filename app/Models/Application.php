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

    protected $casts = [
        'date_of_birth' => 'date',
        'jamb_score' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
}
