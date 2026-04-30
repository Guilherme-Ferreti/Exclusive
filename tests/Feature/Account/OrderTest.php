<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia as Assert;
use Shared\Models\Order;
use Shared\Models\User;

use function Pest\Laravel\actingAs;

it('loads the list orders page', function () {
    $user   = User::factory()->create();
    $orders = Order::factory(2)->for($user)->create();

    actingAs($user)
        ->get(route('account.orders.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Account/Orders/Index')
            ->has('orders', 2, fn (Assert $page) => $page
                ->has('id')
                ->has('number')
                ->has('orderedAtDay')
                ->has('total')
                ->has('status')
                ->has('statusColor')
            )
        );
});

it('loads the show order page', function () {
    $order = Order::factory()->create();

    actingAs($order->user)
        ->get(route('account.orders.show', ['orderId' => $order->id]))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Account/Orders/Show')
            ->has('order', fn (Assert $page) => $page
                ->where('id', $order->id)
                ->has('number')
                ->has('orderedAt')
                ->has('total')
                ->has('status')
                ->has('statusColor')
                ->has('items', 2, fn (Assert $page) => $page
                    ->has('id')
                    ->has('quantity')
                    ->has('unitPrice')
                    ->has('subtotal')
                    ->has('product', fn (Assert $page) => $page
                        ->has('id')
                        ->has('name')
                    )
                )
            )
        );
});

it('fails to load the show order page for another user', function () {
    $order = Order::factory()->create();

    actingAs(User::factory()->create())
        ->get(route('account.orders.show', ['orderId' => $order->id]))
        ->assertNotFound();
});
