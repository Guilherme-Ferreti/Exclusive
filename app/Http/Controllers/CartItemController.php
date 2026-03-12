<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Cart\AddItemToCart;
use App\Helpers\ToastHelper;
use App\Http\Requests\StoreCartItemRequest;
use Illuminate\Http\RedirectResponse;

final class CartItemController extends Controller
{
    public function store(StoreCartItemRequest $request): RedirectResponse
    {
        app(AddItemToCart::class)->handle($request->input('productId'), $request->integer('quantity'));

        ToastHelper::success('Item added to cart successfully!');

        return redirect()->back();
    }
}
