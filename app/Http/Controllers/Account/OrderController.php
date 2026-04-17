<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Data\Inertia\OrderPreviewData;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Inertia\Response;

final class OrderController extends Controller
{
    public function index(#[CurrentUser] User $user): Response
    {
        $orders = $user->orders()->get();

        return inertia('Account/Orders/Index', [
            'orders' => OrderPreviewData::collect($orders),
        ]);
    }
}
