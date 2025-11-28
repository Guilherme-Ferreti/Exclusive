<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');

Route::get('/about-us', fn () => Inertia::render('AboutUs'))->name('about-us');

Route::get('/contact', fn () => inertia('Contact'))->name('contact.create');

Route::middleware('guest')
    ->group(function () {
        Route::get('/sign-up', [SignUpController::class, 'create'])->name('auth.sign-up.create');
        Route::post('/sign-up', [SignUpController::class, 'store'])->name('auth.sign-up.store');
        Route::get('/login', [LoginController::class, 'create'])->name('auth.login.create');
        Route::post('/login', [LoginController::class, 'store'])->name('auth.login.store');
    });

Route::prefix('/account')
    ->name('account.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/orders', fn () => inertia('Account/Orders/Index'))->name('orders.index');
        Route::get('/orders/{orderId}', fn () => inertia('Account/Orders/Show'))->name('orders.show');

        Route::get('/profile', fn () => inertia('Account/Profile/Edit'))->name('profile.edit');

        Route::get('/wishlist', fn () => inertia('Account/Wishlist'))->name('wishlist');
        Route::get('/cart', fn () => inertia('Account/Cart'))->name('cart');
    });
