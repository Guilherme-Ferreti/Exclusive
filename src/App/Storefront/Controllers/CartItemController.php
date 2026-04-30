<?php

declare(strict_types=1);

namespace App\Storefront\Controllers;

use App\Storefront\Actions\AddItemToCart;
use App\Storefront\Actions\GetCart;
use App\Storefront\Requests\StoreCartItemRequest;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Shared\Base\Controller;
use Shared\Helpers\ToastHelper;
use Shared\Models\User;

final class CartItemController extends Controller
{
    public function store(StoreCartItemRequest $request, #[CurrentUser] User $user): RedirectResponse
    {
        $cart = app(GetCart::class)->handle($user);

        app(AddItemToCart::class)->handle(
            cart: $cart,
            productId: $request->input('productId'),
            quantity: $request->integer('quantity')
        );

        ToastHelper::success('Item added to cart successfully!');

        return redirect()->back();
    }
}
