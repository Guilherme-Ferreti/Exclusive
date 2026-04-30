<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Models\Cart;
use Shared\Models\CartItem;
use Shared\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Shared\Models\CartItem>
 */
final class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        return [
            'cart_id'    => Cart::factory(),
            'product_id' => Product::factory(),
            'quantity'   => fake()->numberBetween(1, 10),
        ];
    }
}
