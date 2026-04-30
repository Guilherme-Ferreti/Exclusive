<?php

declare(strict_types=1);

use App\Account\Controllers\ForgotPasswordController;
use App\Account\Controllers\LoginController;
use App\Account\Controllers\OrderController;
use App\Account\Controllers\ProfileController;
use App\Account\Controllers\ResetPasswordController;
use App\Account\Controllers\SignUpController;
use App\Account\Controllers\ToggleWishlistItemController;
use App\Account\Controllers\WishlistController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

Route::prefix('/account')->name('account.')->group(function () {
    Route::get('/sign-up', [SignUpController::class, 'create'])->name('auth.sign-up.create')->middleware('guest');
    Route::post('/sign-up', [SignUpController::class, 'store'])->name('auth.sign-up.store')->middleware('guest', HandlePrecognitiveRequests::class);

    Route::get('/login', [LoginController::class, 'create'])->name('auth.login.create')->middleware('guest');
    Route::post('/login', [LoginController::class, 'store'])->name('auth.login.store')->middleware('guest');
    Route::delete('/login', [LoginController::class, 'destroy'])->name('auth.login.destroy')->middleware('auth');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('auth.forgot-password.create')->middleware('guest');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('auth.forgot-password.store')->middleware('guest');

    Route::get('/reset-password', [ResetPasswordController::class, 'create'])->name('auth.reset-password.create')->middleware('guest');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('auth.reset-password.store')->middleware('guest');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth', HandlePrecognitiveRequests::class);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
    Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');

    Route::get('/wishlist', WishlistController::class)->name('wishlist')->middleware('auth');
    Route::post('/wishlist/{product}/toggle', ToggleWishlistItemController::class)->name('wishlist.toggle')->middleware('auth');
});
