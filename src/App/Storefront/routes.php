<?php

declare(strict_types=1);

use App\Storefront\Controllers\AboutUsController;
use App\Storefront\Controllers\CartCheckoutController;
use App\Storefront\Controllers\CartController;
use App\Storefront\Controllers\CartItemController;
use App\Storefront\Controllers\ContactController;
use App\Storefront\Controllers\HomeController;
use App\Storefront\Controllers\ProductController;
use App\Storefront\Controllers\SyncCartItemsController;
use Illuminate\Support\Facades\Route;

Route::name('storefront.')->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::get('/about-us', AboutUsController::class)->name('about-us');
    Route::get('/contact', ContactController::class)->name('contact');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/cart', [CartController::class, 'edit'])->name('cart.edit')->middleware('auth');
    Route::patch('/cart', [CartController::class, 'update'])->name('cart.update')->middleware('auth');

    Route::post('/cart/checkout', CartCheckoutController::class)->name('cart.checkout')->middleware('auth');

    Route::post('/cart/items', [CartItemController::class, 'store'])->name('cart.items.store')->middleware('auth');
    Route::put('/cart/items/sync', SyncCartItemsController::class)->name('cart.items.sync')->middleware('auth');
});
