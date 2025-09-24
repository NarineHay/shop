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

    public function show(string $locale, string $category_slug, string $slug)
    {

        $product = $this->service->getBySlug($slug);
        $releatedProducts = $this->service->releatedProducts( $product->id, $product->category_id);

        return Inertia::render(
            'Products/SingleProduct',
            [
                'product' => $product,
                'releatedProducts' => $releatedProducts
            ]
        );
    }
}
