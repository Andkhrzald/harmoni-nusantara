<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonationProject extends Model
{
    protected $fillable = [
        'title',
        'description',
        'target_amount',
        'current_amount',
        'religion_scope',
        'cover_image',
        'status',
        'deadline',
        'created_by',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'deadline' => 'date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'project_id');
    }
}
