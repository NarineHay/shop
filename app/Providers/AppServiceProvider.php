<?php

namespace App\Providers;

use App;
use App\Interfaces\Products\ProductInterface;
use App\Interfaces\Users\UserInterface;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        App::useLangPath(base_path('lang'));

        //  Inertia::share([
        //     'locale' => fn() => Session::get('locale', config('app.locale')),
        // ]);

    }
}
