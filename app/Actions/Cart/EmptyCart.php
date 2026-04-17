<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Enums\CacheKey;
use App\Models\Cart;

final class EmptyCart
{
    public function handle(Cart $cart): void
    {
        $cart->items()->delete();

        cache()->forget(CacheKey::cartItems($cart->user->id));
    }
}
