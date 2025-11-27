<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $request->validate([
            'name'               => ['required', 'string', 'max:255'],
            'emailOrPhoneNumber' => ['required', 'string'],
            'password'           => ['required', 'string', Password::default()],
        ]);

        dd($request->safe());
    }
}
