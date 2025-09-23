<?php

namespace App\Http\Controllers\Web\Products;

use App\Helpers\AttributesHelper;
use App\Http\Controllers\Controller;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service)
    {
    }

    public function show(string $locale, string $slug)
    {

        $product = $this->service->getBySlug($slug);
        $attributes = AttributesHelper::getAll();

        return Inertia::render(
            'Products/SingleProduct',
            [
                'product' => $product,
                'attributes' => $attributes
            ]
        );
    }
}
