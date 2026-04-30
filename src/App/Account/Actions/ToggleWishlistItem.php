<?php

declare(strict_types=1);

namespace App\Account\Actions;

use Shared\Enums\CacheKey;
use Shared\Models\User;

final class ToggleWishlistItem
{
    public function handle(User $user, string $productId): void
    {
        $user->wishlistItems()->toggle($productId);

        cache()->forget(CacheKey::wishlist($user->id));
    }
}
