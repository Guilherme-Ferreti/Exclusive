<?php

declare(strict_types=1);

namespace App\Account\Actions;

use Illuminate\Support\Facades\Auth;

final class Logout
{
    public function handle(): void
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
    }
}
