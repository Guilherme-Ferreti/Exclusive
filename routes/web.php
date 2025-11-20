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

Route::get('/sign-up', [SignUpController::class, 'create'])->name('auth.sign-up.create');
Route::get('/login', [LoginController::class, 'create'])->name('auth.login.create');
