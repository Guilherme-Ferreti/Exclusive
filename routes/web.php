<?php

declare(strict_types=1);

use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\WishlistToggleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');

Route::get('/about-us', fn () => Inertia::render('AboutUs'))->name('about-us');

Route::get('/contact', fn () => inertia('Contact'))->name('contact.create');

Route::name('auth.')
    ->group(function () {
        Route::middleware('guest')
            ->group(function () {
                Route::get('/sign-up', [SignUpController::class, 'create'])->name('sign-up.create');
                Route::post('/sign-up', [SignUpController::class, 'store'])->name('sign-up.store')->middleware(HandlePrecognitiveRequests::class);
                Route::get('/login', [LoginController::class, 'create'])->name('login.create');
                Route::post('/login', [LoginController::class, 'store'])->name('login.store');
            });

        Route::post('/logout', [LoginController::class, 'destroy'])->name('login.destroy')->middleware('auth');
    });

Route::prefix('/account')
    ->name('account.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/orders', fn () => inertia('Account/Orders/Index'))->name('orders.index');
        Route::get('/orders/{orderId}', fn () => inertia('Account/Orders/Show'))->name('orders.show');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(HandlePrecognitiveRequests::class);

        Route::get('/wishlist', fn () => inertia('Account/Wishlist'))->name('wishlist');
        Route::post('/wishlist/toggle', WishlistToggleController::class)->name('wishlist.toggle');

        Route::get('/cart', fn () => inertia('Account/Cart'))->name('cart');
    });
