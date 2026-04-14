<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Cart\AddItemToCart;
use App\Helpers\ToastHelper;
use App\Http\Requests\StoreCartItemRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;

final class CartItemController extends Controller
{
    public function store(StoreCartItemRequest $request, #[CurrentUser] User $user): RedirectResponse
    {
        app(AddItemToCart::class)->handle(
            user: $user,
            productId: $request->input('productId'),
            quantity: $request->integer('quantity')
        );

        ToastHelper::success('Item added to cart successfully!');

        return redirect()->back();
    }
}
