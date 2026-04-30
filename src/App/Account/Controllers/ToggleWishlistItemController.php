<?php

declare(strict_types=1);

namespace App\Account\Controllers;

use App\Account\Actions\ToggleWishlistItem;
use Illuminate\Container\Attributes\CurrentUser;
use Shared\Base\Controller;
use Shared\Models\Product;
use Shared\Models\User;

final class ToggleWishlistItemController extends Controller
{
    public function __invoke(Product $product, #[CurrentUser] User $user)
    {
        app(ToggleWishlistItem::class)->handle($user, $product->id);

        return inertia()->back();
    }
}
