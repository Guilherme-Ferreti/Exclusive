<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/sign-up', [SignUpController::class, 'create'])->name('auth.sign-up.create');
Route::get('/login', [LoginController::class, 'create'])->name('auth.login.create');
