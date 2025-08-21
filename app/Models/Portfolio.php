<?php

namespace App\Models;

use App\Filament\Traits\DynamicFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Portfolio extends Model
{
    use SoftDeletes, DynamicFilterTrait;
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

    protected static function booted()
    {
        static::deleting(function ($portfolio) {
            foreach ($portfolio->images as $image) {
                if ($image->path && Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
                $image->delete();
            }
        });
    }

}
