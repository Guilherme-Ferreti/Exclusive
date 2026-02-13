<?php

declare(strict_types=1);

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseHas;

it('successfully loads the edit profile page', function () {
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

it('successfully updates the authenticated user\'s profile', function () {
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

it('allows updating profile with nullable address', function () {
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

it('fails update if missing required fields', function () {
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

it('fails update if email is already taken by another user', function () {
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
