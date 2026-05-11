<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLearningProgress extends Model
{
    protected $fillable = [
        'user_id',
        'content_id',
        'completed',
        'progress_pct',
        'last_accessed',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'progress_pct' => 'integer',
        'last_accessed' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function educationContent(): BelongsTo
    {
        return $this->belongsTo(EducationContent::class, 'content_id');
    }
}
