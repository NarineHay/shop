<?php

namespace App\Repositories\Categories;

use App\Interfaces\Categories\CategoryInterface;
use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct()
    {
        parent::__construct(new Category());
    }

}
