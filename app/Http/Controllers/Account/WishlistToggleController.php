<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Actions\ToggleWishlistedProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\WishlistToggleRequest;

final class WishlistToggleController extends Controller
{
    public function __invoke(WishlistToggleRequest $request)
    {
        app(ToggleWishlistedProduct::class)->handle($request->validated('productId'));

        return inertia()->back();
    }
}
