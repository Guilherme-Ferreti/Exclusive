<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CacheKey;
use App\Models\Product;
use Illuminate\Support\Collection;

final class ListBestSellingProducts
{
    public function handle(): Collection
    {
        return cache()->remember(
            key: CacheKey::BEST_SELLING_PRODUCTS,
            ttl: now()->endOfDay(),
            callback: fn () => $this->fetchBestSellingProducts()
        );
    }

    private function fetchBestSellingProducts(): Collection
    {
        return Product::query()
            ->inRandomOrder()
            ->take(4)
            ->get(['id', 'name', 'preview_image', 'current_price']);
    }
}
