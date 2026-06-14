<?php

namespace App\Repositories\Categories;

use App\Interfaces\Categories\CategoryPageInterface;
use App\Models\CategoryPage;
use App\Repositories\BaseRepository;

class CategoryPageRepository extends BaseRepository implements CategoryPageInterface
{
    public function __construct()
    {
        parent::__construct(new CategoryPage());
    }


    public function getByCategorySlug($slug, $with = []): mixed
    {
        return $this->model
            ->whereHas('category.translations', function ($query) use ($slug) {
                $query->where('slug', $slug)
                    ->where('locale', app()->getLocale());
            })
            ->with($with)
            ->first();
    }


}
