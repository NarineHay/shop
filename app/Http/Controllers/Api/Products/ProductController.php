<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service)
    {
    }

    public function getPrices(Request $request)
    {
        $ids = $request->input('ids', []);

        $products = $this->service->getMoreRows('id', $ids);
// dd($products);
        // $products = Product::whereIn('id', $ids)
        //     ->get(['id',  'price']);

        return response()->json($products);
    }
}
