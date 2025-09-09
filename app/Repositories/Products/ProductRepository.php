<?php

namespace App\Repositories\Products;

use App\Interfaces\Products\ProductInterface;
use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct()
    {
        parent::__construct(new Product());
    }

    public function getFeatured(): mixed
    {
        return $this->model->where('is_featured', true)->get();
    }
}
