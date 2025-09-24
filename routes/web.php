<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AboutUsController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CompareController;
use App\Http\Controllers\Web\Portfolio\PortfolioController;
use App\Http\Controllers\Web\Products\ProductController;
use App\Http\Controllers\Web\WelcomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);

// });
Route::get('/', function () {
    return redirect('/hy');
});
// Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::prefix( '{locale}' )->where( [ 'locale' => '[a-zA-Z]{2}' ] )->group( function()
{
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('/about-us', AboutUsController::class)->name('about_us');
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
    Route::get('/single-portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.single_portfolio');
    Route::get('/compare', CompareController::class)->name('compare');
    Route::get('/cart', CartController::class)->name('cart');


    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{category_slug}/{slug}', [ProductController::class, 'show'])->name('show');
    });

    // Route::post('/products/prices', [ProductController::class, 'getPrices']); // цены для localStorage корзины


    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified_with_locale'])->name('dashboard');
} );



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// test
// test 2
// test 3

require __DIR__.'/auth.php';
