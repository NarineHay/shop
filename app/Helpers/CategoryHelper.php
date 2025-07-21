<?php

namespace App\Helpers;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryHelper
{
    public static function getCategoryTree($parentId = null): Collection
    {
        $categories = Category::with('translations')
            ->where('parent_id', $parentId)
            ->where('active', 1)
            ->orderBy('id')
            ->get();

        return $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'translation' => $category->translation,
                'children' => self::getCategoryTree($category->id),
            ];
        });
    }
}
