<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia as Assert;
use Shared\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('loads the login page', function () {
    get(route('account.auth.login.create'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Account/Auth/Login'));
});

it('logs the user in', function () {
    $user    = User::factory()->create();
    $payload = [
        'email'    => $user->email,
        'password' => 'password',
    ];

    post(route('account.auth.login.store'), $payload)
        ->assertRedirect(route('storefront.home'));

    assertAuthenticatedAs($user);
});

it('fails login if email is incorrect', function () {
    $payload = [
        'email'    => 'nonexistent@example.com',
        'password' => 'password',
    ];

    post(route('account.auth.login.store'), $payload)
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

    post(route('account.auth.login.store'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors('email');

    assertGuest();
});

it('logs the user out', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->delete(route('account.auth.login.destroy'))
        ->assertRedirect(route('storefront.home'));

    assertGuest();
});
