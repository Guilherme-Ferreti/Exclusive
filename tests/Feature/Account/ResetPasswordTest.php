<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Inertia\Testing\AssertableInertia as Assert;
use Shared\Models\User;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('loads the reset password page', function () {
    $user  = User::factory()->create();
    $token = Password::broker()->createToken($user);

    $payload = [
        'token' => $token,
        'email' => $user->email,
    ];

    get(route('account.auth.reset-password.create', $payload))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Account/Auth/ResetPassword')
            ->where('token', $token)
            ->where('email', $user->email)
        );
});

it('resets password with valid token', function () {
    $user  = User::factory()->create();
    $token = Password::broker()->createToken($user);

    $payload = [
        'token'                => $token,
        'email'                => $user->email,
        'password'             => 'newpassword123',
        'passwordConfirmation' => 'newpassword123',
    ];

    post(route('account.auth.reset-password.store'), $payload)
        ->assertRedirectToRoute('account.auth.login.create');

    $user->refresh();

    expect(Hash::check('newpassword123', $user->password))->toBeTrue();
});

it('fails password reset with invalid token', function () {
    $user = User::factory()->create();

    $payload = [
        'token'                => 'invalid-token',
        'email'                => $user->email,
        'password'             => 'newpassword123',
        'passwordConfirmation' => 'newpassword123',
    ];

    post(route('account.auth.reset-password.store'), $payload)
        ->assertRedirectBack();
});

it('validates password reset with mismatched passwords', function () {
    $user  = User::factory()->create();
    $token = Password::broker()->createToken($user);

    $payload = [
        'token'                => $token,
        'email'                => $user->email,
        'password'             => 'newpassword123',
        'passwordConfirmation' => 'differentpassword',
    ];

    post(route('account.auth.reset-password.store'), $payload)
        ->assertRedirectBack();
});
