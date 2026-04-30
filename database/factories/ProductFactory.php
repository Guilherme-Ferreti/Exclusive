<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Models\Category;
use Shared\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Shared\Models\Product>
 */
final class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'          => fake()->words(3, true),
            'description'   => fake()->sentence(),
            'preview_image' => fake()->imageUrl(),
            'detail_image'  => fake()->imageUrl(),
            'current_price' => fake()->numberBetween(100, 1000),
            'category_id'   => Category::factory(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $product->prices()->create([
                'price'      => $product->current_price,
                'started_at' => now(),
            ]);
        });
    }
}
