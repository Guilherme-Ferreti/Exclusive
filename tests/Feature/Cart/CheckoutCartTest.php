<?php

declare(strict_types=1);

use App\Enums\OrderStatus;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\assertDatabaseHas;

it('creates an order from cart items and empties the cart', function () {
    $user     = User::factory()->create();
    $productA = Product::factory()->create();
    $productB = Product::factory()->create();

    $cart = Cart::factory()->for($user)->create();

    CartItem::factory()->for($cart)->for($productA)->create([
        'quantity' => 2,
    ]);

    CartItem::factory()->for($cart)->for($productB)->create([
        'quantity' => 1,
    ]);

    actingAs($cart->user)
        ->post(route('cart.checkout'))
        ->assertRedirect(route('account.orders.index'));

    assertDatabaseEmpty(CartItem::class);
    assertDatabaseCount(Order::class, 1);
    assertDatabaseCount(OrderItem::class, 2);

    $order = $user->orders()->first();

    assertDatabaseHas(Order::class, [
        'id'      => $order->id,
        'total'   => ($productA->current_price * 2) + $productB->current_price,
        'status'  => OrderStatus::PENDING,
        'user_id' => $user->id,
    ]);

    assertDatabaseHas(OrderItem::class, [
        'order_id'   => $order->id,
        'product_id' => $productA->id,
        'quantity'   => 2,
        'unit_price' => $productA->current_price,
    ]);

    assertDatabaseHas(OrderItem::class, [
        'order_id'   => $order->id,
        'product_id' => $productA->id,
        'quantity'   => 2,
        'unit_price' => $productA->current_price,
    ]);
});
