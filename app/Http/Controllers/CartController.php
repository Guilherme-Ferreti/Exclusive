<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\Inertia\CartData;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Inertia\Response;

final class CartController extends Controller
{
    public function __invoke(#[CurrentUser] User $user): Response
    {
        $cart = $user->cart()->with('items.product')->first();

        return inertia('Cart', [
            'cart' => CartData::from($cart),
        ]);
    }
}
