<?php

declare(strict_types=1);

namespace App\Account\Actions;

use Illuminate\Support\Facades\Auth;

final class Login
{
    public function handle(string $email, string $password): bool
    {
        $credentials = [
            'email'    => $email,
            'password' => $password,
        ];

        if (! Auth::attempt($credentials)) {
            return false;
        }

        request()->session()->regenerate();

        return true;
    }
}
