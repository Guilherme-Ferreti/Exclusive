<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia as Assert;
use Shared\Models\Product;
use Shared\Models\User;

use function Pest\Laravel\actingAs;

it('loads the wishlist page', function () {
    $product = Product::factory()->create();
    $user    = User::factory()->hasAttached(factory: $product, relationship: 'wishlistItems')->create();

    actingAs($user)
        ->get(route('account.wishlist'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Account/Wishlist')
            ->has('products', 1, fn (Assert $page) => $page
                ->where('id', $product->id)
                ->has('name')
                ->has('previewImage')
                ->has('detailImage')
                ->has('currentPrice')
            )
        );
});
