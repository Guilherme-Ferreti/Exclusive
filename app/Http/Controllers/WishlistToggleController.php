<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ToggleWishlistedProduct;
use App\Http\Requests\WishlistToggleRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;

final class WishlistToggleController extends Controller
{
    public function __invoke(WishlistToggleRequest $request, #[CurrentUser] User $user)
    {
        app(ToggleWishlistedProduct::class)->handle($user, $request->validated('productId'));

        return inertia()->back();
    }
}
