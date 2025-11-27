<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

final class SignUpController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/SignUp');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', Password::default()],
        ]);

        $user = User::create([
            ...$data,
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
