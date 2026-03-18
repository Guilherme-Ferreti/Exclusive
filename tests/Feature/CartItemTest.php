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

uses(RefreshDatabase::class);

it('creates a cart and adds an item when storing to an empty cart', function () {
    $user    = User::factory()->create();
    $product = Product::factory()->create();
    $payload = [
        'productId' => $product->id,
        'quantity'  => 2,
    ];

    actingAs($user)
        ->post(route('cart.items.store'), $payload)
        ->assertRedirectBack();

    assertDatabaseHas(Cart::class, [
        'user_id' => $user->id,
    ]);

    assertDatabaseHas(CartItem::class, [
        'product_id' => $product->id,
        'cart_id'    => $user->cart->id,
        'quantity'   => $payload['quantity'],
    ]);
});

it('adds a new item to an existing cart', function () {
    $product = Product::factory()->create();
    $cart    = Cart::factory()->create();

    $payload = [
        'productId' => $product->id,
        'quantity'  => 1,
    ];

    actingAs($cart->user)
        ->post(route('cart.items.store'), $payload)
        ->assertRedirectBack();

    assertDatabaseCount(CartItem::class, 1);

    assertDatabaseHas(CartItem::class, [
        'product_id' => $product->id,
        'cart_id'    => $cart->id,
        'quantity'   => $payload['quantity'],
    ]);
});

it('updates quantity when product already exists in cart', function () {
    $cartItem = CartItem::factory()->create();

    $payload = [
        'productId' => $cartItem->product_id,
        'quantity'  => $cartItem->quantity + 1,
    ];

    actingAs($cartItem->cart->user)
        ->post(route('cart.items.store'), $payload)
        ->assertRedirectBack();

    assertDatabaseCount(CartItem::class, 1);

    assertDatabaseHas(CartItem::class, [
        'product_id' => $cartItem->product_id,
        'cart_id'    => $cartItem->cart->id,
        'quantity'   => $payload['quantity'],
    ]);
});
