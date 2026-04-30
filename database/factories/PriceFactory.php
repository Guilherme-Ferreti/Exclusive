<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Shared\Models\Price>
 */
final class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price'      => fake()->numberBetween(50, 1000),
            'started_at' => now(),
            'ended_at'   => null,
            'product_id' => Product::factory(),
        ];
    }
}
