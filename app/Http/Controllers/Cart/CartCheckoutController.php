<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Actions\Cart\CheckoutCart;
use App\Actions\Cart\GetCart;
use App\Helpers\ToastHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;

final class CartCheckoutController extends Controller
{
    public function __invoke(#[CurrentUser] User $user): RedirectResponse
    {
        $cart = app(GetCart::class)->handle($user);

        if ($cart->items->isEmpty()) {
            ToastHelper::error('Cart is empty!');

            return redirect()->back();
        }

        app(CheckoutCart::class)->handle($cart);

        ToastHelper::success('Order placed successfully!');

        return redirect()->route('account.orders.index');
    }
}
