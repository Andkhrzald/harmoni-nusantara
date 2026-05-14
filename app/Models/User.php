<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'religion_preference', 'role', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $attributes = [
        'role' => 'user',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function learningProgress()
    {
        return $this->hasMany(UserLearningProgress::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function forumMessages()
    {
        return $this->hasMany(ForumMessage::class);
    }

    public function forumParticipants()
    {
        return $this->hasMany(ForumParticipant::class);
    }

    public function forumRooms()
    {
        return $this->hasMany(ForumRoom::class, 'user_id');
    }
}
