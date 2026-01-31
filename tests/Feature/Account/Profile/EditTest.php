<?php

declare(strict_types=1);

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;

it('loads profile edit page for authenticated users', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('account.profile.edit'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Account/Profile/Edit')
            ->where('name', $user->name)
            ->where('email', $user->email)
            ->where('address', $user->address)
        );
});

it('redirects guests from profile edit page to login', function () {
    get(route('account.profile.edit'))
        ->assertRedirect(route('auth.login.create'));
});

it('updates profile with valid data', function () {
    $user    = User::factory()->create();
    $payload = [
        'name'    => 'Updated Name',
        'email'   => 'updated@example.com',
        'address' => '123 Updated St',
    ];

    actingAs($user)
        ->put(route('account.profile.update'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasNoErrors();

    assertAuthenticatedAs($user);
    assertDatabaseHas(User::class, [
        'id'      => $user->id,
        'name'    => 'Updated Name',
        'email'   => 'updated@example.com',
        'address' => '123 Updated St',
    ]);
});

it('updates profile with nullable address', function () {
    $user    = User::factory()->create(['address' => 'Original Address']);
    $payload = [
        'name'    => 'Updated Name',
        'email'   => 'updated@example.com',
        'address' => null,
    ];

    actingAs($user)
        ->put(route('account.profile.update'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasNoErrors();

    expect($user->refresh()->address)->toBeNull();
});

it('fails update when missing required fields', function () {
    $user    = User::factory()->create();
    $payload = [
        'name'    => null,
        'email'   => null,
        'address' => '123 Updated St',
    ];

    actingAs($user)
        ->put(route('account.profile.update'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors(['name', 'email']);
});

it('allows updating with same email (unique rule ignores current user)', function () {
    $user    = User::factory()->create(['email' => 'user@example.com']);
    $payload = [
        'name'    => 'Updated Name',
        'email'   => $user->email,
        'address' => '123 Updated St',
    ];

    actingAs($user)
        ->put(route('account.profile.update'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasNoErrors();

    assertDatabaseHas(User::class, [
        'id'    => $user->id,
        'name'  => 'Updated Name',
        'email' => 'user@example.com',
    ]);
});

it('fails update when email is already taken by another user', function () {
    $user      = User::factory()->create();
    $otherUser = User::factory()->create(['email' => 'other@example.com']);
    $payload   = [
        'name'    => 'Updated Name',
        'email'   => 'other@example.com',
        'address' => '123 Updated St',
    ];

    actingAs($user)
        ->put(route('account.profile.update'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors('email');
});
