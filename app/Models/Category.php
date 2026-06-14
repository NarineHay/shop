<?php

namespace App\Models;

use App\Filament\Traits\DynamicFilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes, DynamicFilterTrait;

    protected $guarded = [];
    protected $appends = ['translation', 'image_url'];


    // public function parent(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class, 'parent_id');
    // }

    public function parent()
    {
        // return $this->belongsTo(self::class, 'parent_id')->with('translations');
        return $this->belongsTo(self::class, 'parent_id');

    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations?->firstWhere('locale', $locale);
    }

    public function getTranslationAttribute()
    {
        return $this->translations
            ? $this->translations->firstWhere('locale', app()->getLocale())
            : null;
    }


    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function getDepth(): int
    {
        $depth = 0;
        $parent = $this->parent;

        while ($parent instanceof self) {
            $depth++;
            $parent = $parent->parent;
        }

        return $depth;
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image
            ? Storage::disk('public')->url($this->image)
            : null;
    }

    public function page()
    {
        return $this->hasOne(CategoryPage::class);
    }


    protected static function booted(): void
    {
        static::deleting(function (Category $category) {

            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            Storage::disk('public')->deleteDirectory(
                "categories/{$category->id}"
            );
        });
    }
}
