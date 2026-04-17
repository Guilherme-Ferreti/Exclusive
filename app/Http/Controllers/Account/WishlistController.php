<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Data\Inertia\ProductPreviewData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Inertia\Response;

final class WishlistController extends Controller
{
    public function __invoke(#[CurrentUser] User $user): Response
    {
        return inertia('Account/Wishlist', [
            'products' => ProductPreviewData::collect($user->wishlist),
        ]);
    }
}
