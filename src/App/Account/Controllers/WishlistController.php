<?php

declare(strict_types=1);

namespace App\Account\Controllers;

use App\Account\Resources\WishlistItemResource;
use Illuminate\Container\Attributes\CurrentUser;
use Inertia\Response;
use Shared\Base\Controller;
use Shared\Models\User;

final class WishlistController extends Controller
{
    public function __invoke(#[CurrentUser] User $user): Response
    {
        return inertia('Account/Wishlist', [
            'products' => WishlistItemResource::collection($user->wishlistItems),
        ]);
    }
}
