<?php

namespace App\Models;

use Database\Factories\ForumRoomFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumRoom extends Model
{
    /** @use HasFactory<ForumRoomFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'is_active',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ForumMessage::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(ForumParticipant::class);
    }

    public function activeParticipants(): HasMany
    {
        return $this->participants()->where('status', 'active');
    }
}
