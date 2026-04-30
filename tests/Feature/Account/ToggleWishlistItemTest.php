<?php

declare(strict_types=1);

use Shared\Models\Product;
use Shared\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('adds a product to the wishlist', function () {
    $product = Product::factory()->create();
    $user    = User::factory()->create();

    actingAs($user)
        ->post(route('account.wishlist.toggle', ['product' => $product->id]))
        ->assertRedirectBack();

    assertDatabaseHas('wishlists', [
        'user_id'    => $user->id,
        'product_id' => $product->id,
    ]);
});

it('removes a product from the wishlist', function () {
    $product = Product::factory()->create();
    $user    = User::factory()->hasAttached(factory: $product, relationship: 'wishlistItems')->create();

    actingAs($user)
        ->post(route('account.wishlist.toggle', ['product' => $product->id]))
        ->assertRedirectBack();

    assertDatabaseMissing('wishlists', [
        'user_id'    => $user->id,
        'product_id' => $product->id,
    ]);
});
