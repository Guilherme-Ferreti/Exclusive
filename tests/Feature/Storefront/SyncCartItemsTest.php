<?php

declare(strict_types=1);

use Shared\Models\Cart;
use Shared\Models\CartItem;
use Shared\Models\Product;
use Shared\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('syncs cart items by adding, updating, and removing items', function () {
    $user = User::factory()->create();
    $cart = Cart::factory()->for($user)->create();

    $productToUpdate = Product::factory()->create();
    $productToAdd    = Product::factory()->create();
    $productToRemove = Product::factory()->create();

    CartItem::factory()->for($cart)->for($productToUpdate)->create([
        'quantity' => 1,
    ]);

    CartItem::factory()->for($cart)->for($productToRemove)->create([
        'quantity' => 1,
    ]);

    $payload = [
        'items' => [
            ['productId' => $productToUpdate->id, 'quantity' => 2],
            ['productId' => $productToAdd->id, 'quantity' => 1],
        ],
    ];

    actingAs($user)
        ->put(route('storefront.cart.items.sync'), $payload)
        ->assertRedirectBack();

    assertDatabaseCount(CartItem::class, 2);

    assertDatabaseHas(CartItem::class, [
        'cart_id'    => $cart->id,
        'product_id' => $productToUpdate->id,
        'quantity'   => 2,
    ]);

    assertDatabaseHas(CartItem::class, [
        'cart_id'    => $cart->id,
        'product_id' => $productToAdd->id,
        'quantity'   => 1,
    ]);

    assertDatabaseMissing(CartItem::class, [
        'cart_id'    => $cart->id,
        'product_id' => $productToRemove->id,
    ]);
});
