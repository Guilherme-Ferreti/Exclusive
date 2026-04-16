<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

it('syncs cart items by adding, updating, and removing items', function () {
    $user     = User::factory()->create();
    $cart     = Cart::factory()->create(['user_id' => $user->id]);
    $product1 = Product::factory()->create();
    $product2 = Product::factory()->create();
    $product3 = Product::factory()->create();

    CartItem::factory()->create([
        'cart_id'    => $cart->id,
        'product_id' => $product1->id,
        'quantity'   => 1,
    ]);

    CartItem::factory()->create([
        'cart_id'    => $cart->id,
        'product_id' => $product2->id,
        'quantity'   => 1,
    ]);

    actingAs($user)
        ->put(route('cart.items.sync'), [
            'items' => [
                ['productId' => (string) $product1->id, 'quantity' => 5],
                ['productId' => (string) $product3->id, 'quantity' => 3],
            ],
        ])
        ->assertRedirectBack();

    assertDatabaseCount(CartItem::class, 2);

    assertDatabaseHas(CartItem::class, [
        'cart_id'    => $cart->id,
        'product_id' => $product1->id,
        'quantity'   => 5,
    ]);

    assertDatabaseHas(CartItem::class, [
        'cart_id'    => $cart->id,
        'product_id' => $product3->id,
        'quantity'   => 3,
    ]);

    assertDatabaseMissing(CartItem::class, [
        'cart_id'    => $cart->id,
        'product_id' => $product2->id,
    ]);
});
