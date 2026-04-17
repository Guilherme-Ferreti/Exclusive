<?php

declare(strict_types=1);

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('successfully loads the cart page', function () {
    $user = User::factory()->create();

    $cart = Cart::factory()
        ->for($user)
        ->has(CartItem::factory()->count(2), 'items')
        ->create();

    actingAs($user)
        ->get(route('cart.show'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Cart')
            ->has('cart.items', 2, fn (Assert $page) => $page
                ->where('id', $cart->items()->first()->id)
                ->etc()
            )
            ->etc()
        );
});

it('successfully loads the cart page if cart is empty', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('cart.show'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Cart')
            ->has('cart.items', 0)
            ->etc()
        );
});
