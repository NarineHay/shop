<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Portfolio extends Model
{
    protected $guarded = [];
    protected $appends = ['translation_lang'];

    public function translations(): HasMany
    {
        return $this->hasMany(PortfolioTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations->firstWhere('locale', $locale);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class);
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(PortfolioImage::class)->where('is_main', true);
    }

   
    public function getTranslationLangAttribute()
    {
        $locale = app()->getLocale();

        return $this->translations->firstWhere('locale', $locale);
    }

}
