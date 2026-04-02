<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\CacheKey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

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
            callback: fn () => $user->wishlist()->pluck('product_id')->toArray(),
        );
    }
}
