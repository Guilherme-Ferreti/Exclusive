<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ToggleWishlistedProduct;
use App\Http\Requests\WishlistToggleRequest;

final class WishlistToggleController extends Controller
{
    public function __invoke(WishlistToggleRequest $request)
    {
        app(ToggleWishlistedProduct::class)->handle($request->validated('productId'));

        return inertia()->back();
    }
}
