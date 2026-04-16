<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Cart\SyncCartItems;
use App\Helpers\ToastHelper;
use App\Http\Requests\SyncCartItemsRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;

final class SyncCartItemsController extends Controller
{
    public function __invoke(SyncCartItemsRequest $request, #[CurrentUser] User $user)
    {
        app(SyncCartItems::class)->handle($user->cart, $request->validated('items'));

        ToastHelper::success('Items updated successfully!');

        return redirect()->back();
    }
}
