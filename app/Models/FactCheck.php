<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FactCheck extends Model
{
    protected $fillable = [
        'author_id',
        'title',
        'content',
        'verdict',
        'source_link',
        'google_api_ref',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
