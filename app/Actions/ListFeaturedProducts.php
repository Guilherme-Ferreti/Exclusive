<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CacheKey;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

final class ListFeaturedProducts
{
    public function handle(): Collection
    {
        return cache()->remember(
            key: CacheKey::FEATURED_PRODUCTS,
            ttl: now()->endOfDay(),
            callback: fn () => $this->fetchFeaturedProducts()
        );
    }

    private function fetchFeaturedProducts(): Collection
    {
        return Product::query()
            ->inRandomOrder()
            ->whereNotNull('preview_image')
            ->take(10)
            ->get(['id', 'name', 'preview_image', 'current_price']);
    }
}
