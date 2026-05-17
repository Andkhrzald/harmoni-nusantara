<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReligiousHighlight extends Model
{
    protected $fillable = [
        'religion_id',
        'type',
        'name',
        'description',
        'image_url',
        'location',
        'reference_url',
        'sort_order',
    ];

    public function religion()
    {
        return $this->belongsTo(ReligionCategory::class, 'religion_id');
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->latest();
    }
}
