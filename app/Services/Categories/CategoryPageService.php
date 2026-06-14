<?php

namespace App\Services\Categories;

use App\Interfaces\BaseInterface;
use App\Interfaces\Categories\CategoryPageInterface;
use App\Services\BaseService;

class CategoryPageService extends BaseService
{

    public function __construct(CategoryPageInterface $repository)
    {
        parent::__construct($repository);
    }

    public function getByCategorySlug($slug, $with = []): mixed
    {
        return $this->repository->getByCategorySlug($slug, ['translations','category.children']);
    }
}
