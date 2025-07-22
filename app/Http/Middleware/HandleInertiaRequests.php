<?php

namespace App\Http\Middleware;

use App\Helpers\CategoryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $locale = in_array(request()->segment(1), ['hy', 'ru', 'en']) ? request()->segment(1) : 'hy';

        $name = request()->route()->getName();
        $file = resource_path('lang/' . $locale . '/' . $name . ".json");
        $formFile = resource_path('lang/' . $locale . "/form.json");
        // $navbarFile = lang_path($lang . "/navbar.json");

        $categories = CategoryHelper::getCategoryTree();

        return [
            ...parent::share($request),
            'categories' => $categories,
            'locale' => $locale,
            'locales' => ['hy', 'ru', 'en'],
            'auth' => [
                'user' => $request->user(),
            ],

            'translations' => [
                'form' => File::exists($formFile) ? File::json($formFile) : [],
                'page' => File::exists($file) ? File::json($file) : [],
                // 'navbar' => File::exists($navbarFile) ? File::json($navbarFile) : []
            ],
        ];
    }
}
