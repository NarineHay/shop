<?php

namespace App\Interfaces\Categories;

use App\Interfaces\BaseInterface;

interface CategoryPageInterface extends BaseInterface
{
    public function getByCategorySlug($slug, $with = []): mixed;
}
