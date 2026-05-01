<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Enums\OrderStatus;
use Shared\Helpers\OrderHelper;
use Shared\Models\Order;
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
            'number'  => OrderHelper::generateNumber(),
            'total'   => 0,
            'status'  => fake()->randomElement([OrderStatus::PENDING, OrderStatus::SHIPPED, OrderStatus::DELIVERED]),
            'user_id' => User::factory(),
        ];
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
