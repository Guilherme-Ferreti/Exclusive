<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Enums\CacheKey;
use App\Models\Cart;

final class AddItemToCart
{
    public function handle(Cart $cart, string $productId, int $quantity): void
    {
        $cart->items()->updateOrCreate(
            attributes: [
                'product_id' => $productId,
            ],
            values: [
                'quantity' => $quantity,
            ]
        );

        cache()->forget(CacheKey::cartItems($cart->user->id));
    }
}
