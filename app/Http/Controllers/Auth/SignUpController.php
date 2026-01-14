<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final class SignUpController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/SignUp');
    }

    public function store(SignUpRequest $request): RedirectResponse
    {
        $user = User::create([
            ...$request->validated(),
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
