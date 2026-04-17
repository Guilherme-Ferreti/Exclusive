<?php

declare(strict_types=1);

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('successfully loads the sign up page', function () {
    get(route('auth.sign-up.create'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/SignUp'));
});

it('successfully registers a new user', function () {
    $payload = [
        'name'     => 'John Doe',
        'email'    => 'john@example.com',
        'password' => 'password123',
    ];

    post(route('auth.sign-up.store'), $payload)
        ->assertRedirect(route('home'));

    assertDatabaseCount(User::class, 1);
    assertDatabaseHas(User::class, [
        'name'  => 'John Doe',
        'email' => 'john@example.com',
    ]);

    assertAuthenticatedAs(User::where('email', 'john@example.com')->first());
});

it('fails registration with missing required fields', function () {
    $payload = [
        'name'     => null,
        'email'    => null,
        'password' => null,
    ];

    post(route('auth.sign-up.store'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors(['name', 'email', 'password']);

    assertGuest();
    assertDatabaseCount(User::class, 0);
});

it('fails registration with invalid email format', function () {
    $payload = [
        'name'     => 'Test User',
        'email'    => 'invalid-email-format',
        'password' => 'password123',
    ];

    post(route('auth.sign-up.store'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors('email');

    assertGuest();
    assertDatabaseCount(User::class, 0);
});

it('fails registration with duplicate email', function () {
    $existingUser = User::factory()->create(['email' => 'existing@example.com']);

    $payload = [
        'name'     => 'New User',
        'email'    => 'existing@example.com',
        'password' => 'password123',
    ];

    post(route('auth.sign-up.store'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors('email');

    assertGuest();
    assertDatabaseCount(User::class, 1);
});
