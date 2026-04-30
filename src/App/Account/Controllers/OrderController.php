<?php

declare(strict_types=1);

namespace App\Account\Controllers;

use App\Account\Resources\OrderIndexResource;
use App\Account\Resources\OrderShowResource;
use Illuminate\Container\Attributes\CurrentUser;
use Inertia\Response;
use Shared\Base\Controller;
use Shared\Models\User;

final class OrderController extends Controller
{
    public function index(#[CurrentUser] User $user): Response
    {
        $orders = $user->orders()->latest()->get();

        return inertia('Account/Orders/Index', [
            'orders' => OrderIndexResource::collection($orders),
        ]);
    }

    public function show(string $orderId, #[CurrentUser] User $user): Response
    {
        $order = $user->orders()->with('items.product')->findOrFail($orderId);

        return inertia('Account/Orders/Show', [
            'order' => new OrderShowResource($order),
        ]);
    }
}
