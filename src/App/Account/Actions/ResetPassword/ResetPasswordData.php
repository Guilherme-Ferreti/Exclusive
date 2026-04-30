<?php

declare(strict_types=1);

namespace App\Account\Actions\ResetPassword;

use Illuminate\Http\Request;

final class ResetPasswordData
{
    public function __construct(
        public string $token,
        public string $email,
        public string $password,
        public string $password_confirmation
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            token: $request->input('token'),
            email: $request->input('email'),
            password: $request->input('password'),
            password_confirmation: $request->input('passwordConfirmation'),
        );
    }
}
