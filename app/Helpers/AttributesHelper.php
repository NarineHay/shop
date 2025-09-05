<?php

namespace App\Helpers;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Support\Collection;

class AttributesHelper
{
    public static function getAll(): Collection
    {
        $attributes = Attribute::with(['translations', 'values.translations'])->get();

        return $attributes;
    }
}
