<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('passes browser health checks', function () {
    Category::factory(10)
        ->has(Product::factory(5))
        ->create();

    $user = User::factory()->create();

    $unauthenticatedRoutes = [
        route('home'),
        route('about-us'),
        route('contact.create'),
        route('auth.login.create'),
        route('auth.sign-up.create'),
    ];

    $authenticatedRoutes = [
        route('account.profile.edit'),
    ];

    visit($unauthenticatedRoutes)
        ->assertNoSmoke();

    actingAs($user);

    visit($authenticatedRoutes)
        ->assertNoSmoke();
});
