<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Enums\CacheKey;
use App\Models\User;

final class AddItemToCart
{
    public function handle(User $user, string $productId, int $quantity): void
    {
        $cart = $user->cart()->firstOrCreate();

        $cart->items()->updateOrCreate(
            attributes: [
                'product_id' => $productId,
            ],
            values: [
                'quantity' => $quantity,
            ]
        );

        cache()->forget(CacheKey::cartItems($user->id));
    }
}
