<?php

namespace App\Models;

use Database\Factories\ForumMessageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumMessage extends Model
{
    /** @use HasFactory<ForumMessageFactory> */
    use HasFactory, Prunable;

    protected $fillable = [
        'forum_room_id',
        'user_id',
        'content',
        'is_ai',
    ];

    public $timestamps = false;

    protected $casts = [
        'is_ai' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(ForumRoom::class, 'forum_room_id');
    }

    public function prunable(): Illuminate\Database\Eloquent\Builder
    {
        return static::where('created_at', '<', now()->subDay());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'AI Assistant',
        ]);
    }
}
