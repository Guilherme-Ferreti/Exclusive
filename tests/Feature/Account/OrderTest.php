<?php

declare(strict_types=1);

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;

it('successfully loads the order index page', function () {
    $user = User::factory()->create();

    $order = Order::factory()->for($user)->create();

    actingAs($user)
        ->get(route('account.orders.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Account/Orders/Index')
            ->has('orders', 1, fn (Assert $page) => $page
                ->where('id', $order->id)
                ->etc()
            )
        );
});

it('successfully loads the order show page', function () {
    $user = User::factory()->create();

    $order = Order::factory()->for($user)->create();

    $product = Product::factory()->create();

    OrderItem::factory()
        ->for($order)
        ->for($product, 'product')
        ->count(2)
        ->create();

    actingAs($user)
        ->get(route('account.orders.show', ['orderId' => $order->id]))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Account/Orders/Show')
            ->has('order', fn (Assert $page) => $page
                ->where('id', $order->id)
                ->has('items', 2)
                ->etc()
            )
        );
});
