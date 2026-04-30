<?php

declare(strict_types=1);

namespace App\Storefront\Actions;

use Shared\Enums\CacheKey;
use Shared\Models\Cart;

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
