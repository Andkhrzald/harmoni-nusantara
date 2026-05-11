<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReligionCategory extends Model
{
    protected $fillable = ['slug', 'name', 'description', 'icon_url'];

    public function educationContents(): HasMany
    {
        return $this->hasMany(EducationContent::class);
    }
}
