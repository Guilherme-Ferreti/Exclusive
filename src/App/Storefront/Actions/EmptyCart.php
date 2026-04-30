<?php

declare(strict_types=1);

namespace App\Storefront\Actions;

use Shared\Enums\CacheKey;
use Shared\Models\Cart;

final class EmptyCart
{
    public function handle(Cart $cart): void
    {
        $cart->items()->delete();

        cache()->forget(CacheKey::cartItems($cart->user->id));
    }
}
