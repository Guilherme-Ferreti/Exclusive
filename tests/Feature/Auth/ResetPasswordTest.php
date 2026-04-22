<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('successfully loads the reset password page', function () {
    $token = Password::broker()->createToken(User::factory()->create());

    $payload = [
        'token' => $token,
        'email' => 'user@example.com',
    ];

    get(route('auth.reset-password.create', $payload))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Auth/ResetPassword')
            ->has('token')
            ->has('email')
        );
});

it('successfully resets password with valid token', function () {
    $user  = User::factory()->create();
    $token = Password::broker()->createToken($user);

    $payload = [
        'token'                => $token,
        'email'                => $user->email,
        'password'             => 'newpassword123',
        'passwordConfirmation' => 'newpassword123',
    ];

    post(route('auth.reset-password.store'), $payload)
        ->assertRedirectToRoute('auth.login.create');

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

    post(route('auth.reset-password.store'), $payload)
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

    post(route('auth.reset-password.store'), $payload)
        ->assertRedirectBack();
});
