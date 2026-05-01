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
            'unit_price' => 0,
            'order_id'   => Order::factory(),
            'product_id' => Product::factory(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (OrderItem $item) {
            $item->unit_price = $item->product->current_price;
            $item->save();
        });
    }
}
