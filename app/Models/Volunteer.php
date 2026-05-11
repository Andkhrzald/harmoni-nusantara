<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Volunteer extends Model
{
    protected $fillable = [
        'user_id',
        'program_name',
        'religion_scope',
        'location',
        'status',
        'motivation',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
