<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('successfully loads the forgot password page', function () {
    get(route('auth.forgot-password.create'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('Auth/ForgotPassword'));
});

it('sends password reset link for valid email', function () {
    Notification::fake();

    $user = User::factory()->create();

    $payload = [
        'email' => $user->email,
    ];

    post(route('auth.forgot-password.store'), $payload)
        ->assertRedirectBack();

    Notification::assertCount(1);
});

it('shows error for non-existent email', function () {
    Notification::fake();

    $payload = [
        'email' => 'nonexistent@example.com',
    ];

    post(route('auth.forgot-password.store'), $payload)
        ->assertRedirectBack()
        ->assertSessionHasErrors('email');

    Notification::assertNothingSent();
});
