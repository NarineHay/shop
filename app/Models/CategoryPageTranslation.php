<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPageTranslation extends Model
{
    protected $guarded = [];

    public function categoryPage()
    {
        return $this->belongsTo(CategoryPage::class);
    }
}
