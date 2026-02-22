<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\WishlistToggleRequest;

final class WishlistToggleController extends Controller
{
    public function __invoke(WishlistToggleRequest $request)
    {
        currentUser()->wishlist()->toggle($request->string('productId'));

        return inertia()->back();
    }
}
