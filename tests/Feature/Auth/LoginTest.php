<?php

declare(strict_types=1);

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('successfully loads the login page', function () {
    get(route('auth.login.create'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

it('successfully logs the user in', function () {
    $user    = User::factory()->create();
    $payload = [
        'email'    => $user->email,
        'password' => 'password',
    ];

    post(route('auth.login.store'), $payload)
        ->assertRedirect(route('home'));

    assertAuthenticatedAs($user);
});

it('fails login if email is incorrect', function () {
    $payload = [
        'email'    => 'nonexistent@example.com',
        'password' => 'password',
    ];

    post(route('auth.login.store'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors('email');

    assertGuest();
});

it('fails login if password is incorrect', function () {
    $user    = User::factory()->create();
    $payload = [
        'email'    => $user->email,
        'password' => 'wrongpassword',
    ];

    post(route('auth.login.store'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors('email');

    assertGuest();
});
