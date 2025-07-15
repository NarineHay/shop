<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function __construct(protected ProductService $service)
    {
    }

    public function index()
    {
        
        $products = $this->service->getActiveRows(['category']);
        dd($products);
        return Inertia::render('Products/Index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->service->getById($id, ['category']);
        return Inertia::render('Products/Show', compact('product'));
    }
}
