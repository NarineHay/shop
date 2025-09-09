<?php

namespace App\Http\Controllers\Web;

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
        $products = $this->service->getMoreRows('id', $request->ids, ['category.translations', 'images', 'attributeValues.attribute']);

        return Inertia::render(
            'Compare',
            [
                'products' => $products
            ]
        );
    }
}
