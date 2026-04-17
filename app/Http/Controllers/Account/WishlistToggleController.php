<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Actions\Account\ToggleWishlistedProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\WishlistToggleRequest;
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
