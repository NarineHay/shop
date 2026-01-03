<?php

namespace App\Http\Controllers\Web;

use App\Helpers\AttributesHelper;
use App\Http\Controllers\Controller;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompareController extends Controller
{
    public function __construct(protected ProductService $service)
    {
    }
    public function __invoke(Request $request)
    {
        $ids = $request->ids ?? [];
        $products = $this->service->getMoreRows('id', $ids, ['category.translations', 'images', 'attributeValues.attribute']);

        $attributes = AttributesHelper::getAll();

        return Inertia::render(
            'Compare',
            [
                'products' => $products,
                'attributes' => $attributes
            ]
        );
    }
}
