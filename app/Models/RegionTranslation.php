<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegionTranslation extends Model
{
    protected $guarded = [];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
