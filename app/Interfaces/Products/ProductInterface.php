<?php

namespace App\Interfaces\Products;

use App\Interfaces\BaseInterface;

interface ProductInterface extends BaseInterface
{
    public function getFeatured(): mixed;
}
