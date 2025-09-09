<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttributeValue extends Model
{
    protected $guarded = [];
    protected $appends = ['translation_lang'];


    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(AttributeValueTranslation::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_attribute_values',
            'attribute_value_id',
            'product_id'
        );
    }

    public function translation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }

    public function getTranslationLangAttribute()
    {
        return $this->translations
            ? $this->translations->firstWhere('locale', app()->getLocale())
            : null;
    }
}
