<?php

declare(strict_types=1);

namespace App\Storefront\Controllers;

use App\Storefront\Actions\CheckoutCart;
use App\Storefront\Actions\GetCart;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Shared\Base\Controller;
use Shared\Helpers\ToastHelper;
use Shared\Models\User;

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
