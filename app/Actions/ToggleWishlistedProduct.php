<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;

final class ToggleWishlistedProduct
{
    public function __construct(#[CurrentUser] private User $user) {}

    public function handle(string $productId): void
    {
        $this->user->wishlist()->toggle($productId);
    }
}
