<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Password;
use Shared\Models\User;

it('renders the reset password page', function () {
    $user  = User::factory()->create();
    $token = Password::broker()->createToken($user);

    $payload = [
        'token' => $token,
        'email' => $user->email,
    ];

    visit(route('account.auth.reset-password.create', $payload))
        ->assertNoSmoke();
});
