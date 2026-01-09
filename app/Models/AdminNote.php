<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNote extends Model
{
    protected $fillable = [
        'application_id',
        'note',
        'is_checked',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
