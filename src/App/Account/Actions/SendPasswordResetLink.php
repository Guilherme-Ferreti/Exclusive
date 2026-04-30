<?php

declare(strict_types=1);

namespace App\Account\Actions;

use Illuminate\Support\Facades\Password;

final class SendPasswordResetLink
{
    public function handle(string $email): string
    {
        return Password::sendResetLink(compact('email'));
    }
}
