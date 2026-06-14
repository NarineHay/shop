<?php

namespace App\Models;

use App\Filament\Traits\DynamicFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class CategoryPage extends Model
{
    use DynamicFilterTrait;

    protected $guarded = [];
    protected $appends = ['translation_lang'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(CategoryPageTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations->firstWhere('locale', $locale);
    }

    public function getTranslationLangAttribute()
    {
        $locale = app()->getLocale();

        return $this->translations->firstWhere('locale', $locale);
    }

    protected static function booted(): void
    {
        static::deleting(function ($categoryPage) {

            if ($categoryPage->banner_image) {
                Storage::disk('public')->delete($categoryPage->banner_image);
            }

            Storage::disk('public')->deleteDirectory(
                "category-pages/{$categoryPage->id}"
            );
        });
    }
}
