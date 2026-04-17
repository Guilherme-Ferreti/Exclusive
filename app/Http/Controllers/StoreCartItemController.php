<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Cart\AddItemToCart;
use App\Actions\Cart\GetCart;
use App\Helpers\ToastHelper;
use App\Http\Requests\StoreCartItemRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;

final class StoreCartItemController extends Controller
{
    public function __invoke(StoreCartItemRequest $request, #[CurrentUser] User $user): RedirectResponse
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
