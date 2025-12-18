<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Region extends Model
{
    protected $guarded = [];

    protected $appends=['name'];

    public function translations(): HasMany
    {
        return $this->hasMany(RegionTranslation::class);
    }


    public function translation(): HasOne
    {
        return $this->hasOne(RegionTranslation::class)->where('locale', app()->getLocale());
    }


    public function getNameAttribute(): string
    {
        return $this->translation?->name ?? '';
    }
}
