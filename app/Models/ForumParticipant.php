<?php

namespace App\Models;

use Database\Factories\ForumParticipantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumParticipant extends Model
{
    /** @use HasFactory<ForumParticipantFactory> */
    use HasFactory;

    protected $fillable = [
        'forum_room_id',
        'user_id',
        'role',
        'status',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(ForumRoom::class, 'forum_room_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
