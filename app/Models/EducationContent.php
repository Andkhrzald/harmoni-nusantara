<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationContent extends Model
{
    protected $fillable = [
        'religion_id',
        'author_id',
        'title',
        'slug',
        'content',
        'content_type',
        'youtube_video_id',
        'thumbnail_url',
        'status',
        'age_group',
        'views_count',
    ];

    public function religion(): BelongsTo
    {
        return $this->belongsTo(ReligionCategory::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function learningProgress(): HasMany
    {
        return $this->hasMany(UserLearningProgress::class);
    }
}
