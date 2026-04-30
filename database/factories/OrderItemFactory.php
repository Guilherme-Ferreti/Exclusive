<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Models\Order;
use Shared\Models\OrderItem;
use Shared\Models\Product;

/**
 * @extends Factory<OrderItem>
 */
final class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'quantity'   => fake()->numberBetween(1, 10),
            'unit_price' => fake()->numberBetween(100, 1000),
            'order_id'   => Order::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
