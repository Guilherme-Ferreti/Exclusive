<?php

declare(strict_types=1);

use Shared\Models\Order;

it('renders the list orders page', function () {
    Order::factory(20)->create();

    visit(route('account.orders.index'))
        ->assertNoSmoke();
});

it('renders the show order page', function () {
    $order = Order::factory()->create();

    visit(route('account.orders.show', ['orderId' => $order->id]))
        ->assertNoSmoke();
});
