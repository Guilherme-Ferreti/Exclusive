<?php

declare(strict_types=1);

namespace App\Storefront\Controllers;

use App\Storefront\Actions\GetCart;
use App\Storefront\Resources\CartEditResource;
use Illuminate\Container\Attributes\CurrentUser;
use Inertia\Response;
use Shared\Base\Controller;
use Shared\Models\User;

final class CartController extends Controller
{
    public function edit(#[CurrentUser] User $user): Response
    {
        $cart = app(GetCart::class)->handle($user);

        return inertia('Storefront/Cart/Edit', [
            'cart' => new CartEditResource($cart),
        ]);
    }
}
