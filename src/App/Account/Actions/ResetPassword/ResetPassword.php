<?php

declare(strict_types=1);

namespace App\Account\Actions\ResetPassword;

use Illuminate\Support\Facades\Password;
use Shared\Models\User;

final class ResetPassword
{
    public function handle(ResetPasswordData $data): string
    {
        return Password::reset(
            credentials: [
                'token'                 => $data->token,
                'email'                 => $data->email,
                'password'              => $data->password,
                'password_confirmation' => $data->password_confirmation,
            ],
            callback: function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password,
                ])->save();
            }
        );
    }
}
