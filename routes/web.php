<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AboutUsController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\CompareController;
use App\Http\Controllers\Web\Contact\ContactController;
use App\Http\Controllers\Web\ContactAsController;
use App\Http\Controllers\Web\Portfolio\DashboardController;
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
    Route::get('/contact-us', [ContactAsController::class, 'index'])->name('contact_us');
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
    Route::get('/single-portfolio/{id}', [PortfolioController::class, 'show'])->name('portfolio.single_portfolio');
    Route::get('/compare', CompareController::class)->name('compare');
    Route::get('/cart', CartController::class)->name('cart');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Route::prefix('products')->group(function () {
        Route::get('/products/{category_slug}', [ProductController::class, 'index'])->name('products');
        Route::get('/products/{category_slug}/{slug}', [ProductController::class, 'show'])->name('products.product_show');
    // });

    // Route::post('/products/prices', [ProductController::class, 'getPrices']); // цены для localStorage корзины
    Route::post('/contact', ContactController::class)->name('contact');

    // Route::get('dashboard', DashboardController::class)->middleware(['auth', 'verified_with_locale'])->name('dashboard');
    // Route::get('dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->middleware(['auth', 'verified_with_locale'])->name('dashboard');
} );



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// test 1


require __DIR__.'/auth.php';
//
//1

