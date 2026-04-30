<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia as Assert;
use Shared\Models\Cart;
use Shared\Models\CartItem;
use Shared\Models\User;

use function Pest\Laravel\actingAs;

it('loads the cart edit page', function () {
    $user = User::factory()->create();
    $cart = Cart::factory()->for($user)->has(CartItem::factory(2), 'items')->create();

    actingAs($user)
        ->get(route('storefront.cart.edit'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Storefront/Cart/Edit')
            ->has('cart', fn (Assert $page) => $page
                ->has('subtotal')
                ->has('shippingCosts')
                ->has('total')
                ->has('items', 2, fn (Assert $page) => $page
                    ->where('id', $cart->items[0]->id)
                    ->has('quantity')
                    ->has('subtotal')
                    ->has('product', fn (Assert $page) => $page
                        ->where('id', $cart->items[0]->product_id)
                        ->has('name')
                        ->has('previewImage')
                        ->has('detailImage')
                        ->has('currentPrice')
                    )
                )
            )
        );
});
