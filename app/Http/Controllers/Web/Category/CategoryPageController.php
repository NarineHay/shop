<?php

namespace App\Http\Controllers\Web\Category;

use App\Http\Controllers\Controller;
// use App\Http\Requests\CategoryPage\CategoryPageRequest;
use App\Services\Categories\CategoryPageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryPageController extends Controller
{

    public function __construct(protected CategoryPageService $service)
    {
    }
    public function __invoke(Request $request)
    {

        $categoryPage = $this->service->getByCategorySlug($request->slug);

        return Inertia::render('CategoryPage/Index',
                    [
                        'categoryPage' => $categoryPage
                    ]
                );

    }
}
