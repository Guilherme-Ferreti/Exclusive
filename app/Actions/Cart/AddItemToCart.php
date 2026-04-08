<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Enums\CacheKey;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;

final class AddItemToCart
{
    public function __construct(
        #[CurrentUser] private User $user
    ) {}

    public function handle(string $productId, int $quantity): void
    {
        $cart = $this->user->cart()->firstOrCreate();

        $cart->items()->updateOrCreate(
            attributes: [
                'product_id' => $productId,
            ],
            values: [
                'quantity' => $quantity,
            ]
        );

        cache()->forget(CacheKey::cartItemsCount($this->user->id));
    }
}
