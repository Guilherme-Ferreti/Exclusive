<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\User;

final class GetCart
{
    public function handle(User $user): Cart
    {
        return $user->cart()->firstOrCreate();
    }
}
