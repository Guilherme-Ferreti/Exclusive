<?php

declare(strict_types=1);

namespace App\Storefront\Actions;

use Illuminate\Database\Eloquent\Collection;
use Shared\Enums\CacheKey;
use Shared\Models\Product;

final class ListFeaturedProducts
{
    /**
     * @return Collection<int, Product>
     */
    public function handle(): Collection
    {
        return cache()->remember(
            key: CacheKey::FEATURED_PRODUCTS,
            ttl: now()->endOfDay(),
            callback: fn () => $this->fetchFeaturedProducts()
        );
    }

    /**
     * @return Collection<int, Product>
     */
    private function fetchFeaturedProducts(): Collection
    {
        return Product::query()
            ->inRandomOrder()
            ->whereNotNull('preview_image')
            ->take(10)
            ->get(['id', 'name', 'preview_image', 'detail_image', 'current_price']);
    }
}
