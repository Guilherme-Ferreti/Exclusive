<?php

declare(strict_types=1);

use App\Http\Controllers\Account\OrderController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\WishlistController;
use App\Http\Controllers\Account\WishlistToggleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Cart\CartCheckoutController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\StoreCartItemController;
use App\Http\Controllers\Cart\SyncCartItemsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/about-us', fn () => inertia('AboutUs'))->name('about-us');

Route::get('/contact', fn () => inertia('Contact'))->name('contact.create');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

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

Route::prefix('/cart')
    ->name('cart.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', CartController::class)->name('show');
        Route::post('/checkout', CartCheckoutController::class)->name('checkout');

        Route::post('/items', StoreCartItemController::class)->name('items.store');
        Route::put('/items/sync', SyncCartItemsController::class)->name('items.sync');
    });

Route::prefix('/account')
    ->name('account.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(HandlePrecognitiveRequests::class);

        Route::get('/wishlist', WishlistController::class)->name('wishlist');
        Route::post('/wishlist/toggle', WishlistToggleController::class)->name('wishlist.toggle');
    });
