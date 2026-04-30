<?php

declare(strict_types=1);

namespace App\Storefront\Controllers;

use App\Storefront\Actions\SyncCartItems;
use App\Storefront\Requests\SyncCartItemsRequest;
use Illuminate\Container\Attributes\CurrentUser;
use Shared\Base\Controller;
use Shared\Helpers\ToastHelper;
use Shared\Models\User;

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
