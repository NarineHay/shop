<?php

namespace App\Http\Controllers\Web\Products;

use App\Helpers\AttributesHelper;
use App\Http\Controllers\Controller;
use App\Services\Categories\CategoryService;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(
            protected ProductService $service,
            protected CategoryService $categoryService

        )
    {
    }

    public function index(string $locale, string $category_slug)
    {

        // $products = $this->service->queryActiveRows( ['category.translations', 'images', 'attributeValues.attribute'])->paginate(2);
        $filters = request()->only(['categories', 'attributes', 'price_min', 'price_max']);

        $products = $this->service->getFilteredProducts($filters, 9, $category_slug);
        $attributes = AttributesHelper::getAll();
        $categorychildren = $this->categoryService->getChildrenBySlug($category_slug);

        return Inertia::render(
            'Products/Index',
            [
                'products' => $products,
                'attributes' => $attributes,
                'categorychildren' => $categorychildren,
                'filters' => $filters
            ]
        );
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
