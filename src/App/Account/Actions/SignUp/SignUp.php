<?php

declare(strict_types=1);

namespace App\Account\Actions\SignUp;

use Shared\Models\User;

final class SignUp
{
    public function handle(SignUpData $data): User
    {
        return User::create([
            'name'              => $data->name,
            'email'             => $data->email,
            'password'          => $data->password,
            'email_verified_at' => now(),
        ]);
    }
}
