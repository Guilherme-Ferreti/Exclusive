<?php

declare(strict_types=1);

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('loads login page for guests', function () {
    get(route('auth.login.create'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
});

it('redirects authenticated users from login page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('auth.login.create'))
        ->assertRedirect(route('home'));
});

it('allows users to login with valid credentials and redirects to home', function () {
    $user    = User::factory()->create();
    $payload = [
        'email'    => $user->email,
        'password' => 'password',
    ];

    post(route('auth.login.store'), $payload)
        ->assertRedirect(route('home'));

    assertAuthenticatedAs($user);
});

it('fails login with invalid email', function () {
    $payload = [
        'email'    => 'nonexistent@example.com',
        'password' => 'password',
    ];

    post(route('auth.login.store'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors('email');

    assertGuest();
});

it('fails login with invalid password', function () {
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
