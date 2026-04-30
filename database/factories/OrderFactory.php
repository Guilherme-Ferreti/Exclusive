<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Shared\Enums\OrderStatus;
use Shared\Models\Order;
use Shared\Models\OrderItem;
use Shared\Models\User;

/**
 * @extends Factory<Order>
 */
final class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'number'  => Str::upper(Str::random(8)),
            'total'   => fake()->numberBetween(100, 10000),
            'status'  => OrderStatus::PENDING,
            'user_id' => User::factory(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
            OrderItem::factory(2)->for($order)->create();
        });
    }

    public function pending(): static
    {
        return $this->state([
            'status' => OrderStatus::PENDING,
        ]);
    }

    public function shipped(): static
    {
        return $this->state([
            'status' => OrderStatus::SHIPPED,
        ]);
    }

    public function delivered(): static
    {
        return $this->state([
            'status' => OrderStatus::DELIVERED,
        ]);
    }
}
