<?php

declare(strict_types=1);

namespace Shared\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Shared\Enums\CacheKey;
use Shared\Models\CartItem;
use Shared\Models\User;

final class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'isGuest'         => Auth::guest(),
                'isAuthenticated' => Auth::check(),
                'user'            => $request->user()?->only(['id', 'name', 'email']),
                'wishlist'        => $this->userWishlist($request->user()),
                'cartItems'       => $this->userCartItems($request->user()),
            ],
        ];
    }

    private function userWishlist(?User $user): array
    {
        if (! $user) {
            return [];
        }

        return cache()->remember(
            key: CacheKey::wishlist($user->id),
            ttl: now()->endOfDay(),
            callback: fn () => $user->wishlistItems()->pluck('product_id')->toArray(),
        );
    }

    private function userCartItems(?User $user): ?array
    {
        if (! $user) {
            return null;
        }

        return cache()->remember(
            key: CacheKey::cartItems($user->id),
            ttl: now()->endOfDay(),
            callback: fn () => $user->cart?->items->map(fn (CartItem $item) => [
                'productId' => $item->product_id,
                'quantity'  => $item->quantity,
            ])->toArray(),
        );
    }
}
