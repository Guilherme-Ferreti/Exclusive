<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\WishlistToggleRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

final class WishlistToggleController extends Controller
{
    public function __invoke(WishlistToggleRequest $request)
    {
        Auth::user()->wishlist()->toggle($request->string('productId'));

        return Inertia::back();
    }
}
