<?php

declare(strict_types=1);

namespace App\Actions\Account;

use App\Enums\CacheKey;
use App\Models\User;

final class ToggleWishlistedProduct
{
    public function handle(User $user, string $productId): void
    {
        $user->wishlist()->toggle($productId);

        cache()->forget(CacheKey::wishlist($user->id));
    }
}
