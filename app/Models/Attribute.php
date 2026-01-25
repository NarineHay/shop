<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    protected $guarded = [];

    protected $appends = ['translation_lang'];

    public function translations(): HasMany
    {
        return $this->hasMany(AttributeTranslation::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->translations->firstWhere('locale', $locale);
    }

    public function getTranslationLangAttribute()
    {
        return $this->translations
            ? $this->translations->firstWhere('locale', app()->getLocale())
            : null;
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
