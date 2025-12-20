<?php

namespace App\Services\Cart;

use App\Interfaces\Products\ProductInterface;
use App\Services\BaseService;

class CartService extends BaseService
{

    public function __construct( ProductInterface $repository)
    {
        parent::__construct($repository);
    }

    // public function getFeatured(): mixed
    // {
    //     return $this->repository->getFeatured();
    // }
}
