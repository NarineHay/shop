<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AboutUsController;
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
require __DIR__.'/auth.php';
