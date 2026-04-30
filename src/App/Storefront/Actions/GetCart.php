<?php

declare(strict_types=1);

namespace App\Storefront\Actions;

use Shared\Models\Cart;
use Shared\Models\User;

final class GetCart
{
    public function handle(User $user): Cart
    {
        return $user->cart()->firstOrCreate();
    }
}
