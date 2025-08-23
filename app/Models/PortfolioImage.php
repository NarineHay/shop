<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PortfolioImage extends Model
{
    protected $guarded = [];
    protected $appends = ['path_url'];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function getPathUrlAttribute(): ?string
    {
        return $this->path ? asset('storage/' . $this->path) : null;
    }

    protected static function booted()
    {
        static::saving(function ($image) {
            if ($image->is_main) {
                static::where('portfolio_id', $image->portfolio_id)
                    ->where('id', '!=', $image->id)
                    ->update(['is_main' => false]);
            }
        });

        static::deleting(function ($model) {
            if ($model->path) {
                Storage::disk('public')->delete($model->path);
            }
        });
    }


}
