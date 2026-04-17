<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Actions\Cart\SyncCartItems;
use App\Helpers\ToastHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\SyncCartItemsRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;

final class SyncCartItemsController extends Controller
{
    public function __invoke(SyncCartItemsRequest $request, #[CurrentUser] User $user)
    {
        $items = $request->collect('items')->map(fn (array $item) => [
            'productId' => $item['productId'],
            'quantity'  => (int) $item['quantity'],
        ]);

        app(SyncCartItems::class)->handle($user->cart, $items->toArray());

        ToastHelper::success('Items updated successfully!');

        return redirect()->back();
    }
}
