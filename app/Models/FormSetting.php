<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FormSetting extends Model
{
    protected $fillable = [
        'form_name',
        'is_open',
        'opens_at',
        'closes_at',
        'closed_message',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'opens_at' => 'datetime',
        'closes_at' => 'datetime',
    ];

    /**
     * Check if the form is currently open
     */
    public function isCurrentlyOpen(): bool
    {
        if (!$this->is_open) {
            return false;
        }

        $now = Carbon::now();

        // Check if current time is within the open/close window
        if ($this->opens_at && $now->lt($this->opens_at)) {
            return false;
        }

        if ($this->closes_at && $now->gt($this->closes_at)) {
            return false;
        }

        return true;
    }

    /**
     * Get or create a form setting by name
     */
    public static function getByName(string $formName): self
    {
        return self::firstOrCreate(
            ['form_name' => $formName],
            [
                'is_open' => false,
                'closed_message' => 'This form is currently closed.',
            ]
        );
    }
}
