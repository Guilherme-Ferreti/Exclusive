<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shared\Models\Cart;
use Shared\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Shared\Models\Cart>
 */
final class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
        ];
    }
}
