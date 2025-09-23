<?php

namespace App\Services\Products;

use App\Interfaces\Products\ProductInterface;
use App\Models\Product;
use App\Services\BaseService;

class ProductService extends BaseService
{

    public function __construct( ProductInterface $repository)
    {
        parent::__construct($repository);
    }

    public function getBySlug(string $slug): Product
    {
     
        $product = $this->repository->findBySlug($slug);

        // например, какая-то бизнес-логика
        // if (!$product->is_active) throw new \Exception('Product not active');

        return $product;
    }

    // public function getFeatured(): mixed
    // {
    //     return $this->repository->getFeatured();
    // }
}
