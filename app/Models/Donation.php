<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'amount',
        'anonymous_flag',
        'payment_method',
        'payment_status',
        'transaction_ref',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'anonymous_flag' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(DonationProject::class, 'project_id');
    }
}
