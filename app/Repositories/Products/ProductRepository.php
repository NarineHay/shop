<?php

namespace App\Repositories\Products;

use App\Interfaces\Products\ProductInterface;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

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

    public function findBySlug(string $slug): Model
    {

        return $this->model->whereHas('translations', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->with('translations', 'attributeValues.translations', 'attributeValues.attribute.translations', 'images')
            ->firstOrFail();
    }
}
