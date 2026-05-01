<?php

declare(strict_types=1);

namespace App\Storefront\Actions;

use Illuminate\Support\Collection;
use Shared\Enums\CacheKey;
use Shared\Models\Product;

final class ListBestSellingProducts
{
    /**
     * @return Collection<int, Product>
     */
    public function handle(): Collection
    {
        return cache()->remember(
            key: CacheKey::BEST_SELLING_PRODUCTS,
            ttl: now()->endOfDay(),
            callback: fn () => $this->fetchBestSellingProducts()
        );
    }

    /**
     * @return Collection<int, Product>
     */
    private function fetchBestSellingProducts(): Collection
    {
        return Product::query()
            ->withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->take(4)
            ->get(['id', 'name', 'preview_image', 'detail_image', 'current_price']);
    }
}
