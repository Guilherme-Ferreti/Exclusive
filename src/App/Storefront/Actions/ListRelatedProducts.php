<?php

declare(strict_types=1);

namespace App\Storefront\Actions;

use Illuminate\Database\Eloquent\Collection;
use Shared\Models\Product;

final class ListRelatedProducts
{
    /**
     * @return Collection<int, Product>
     */
    public function handle(Product $product): Collection
    {
        return cache()->remember(
            key: "products.{$product->id}.related",
            ttl: now()->endOfDay(),
            callback: fn () => $this->fetchRelatedProducts($product)
        );
    }

    /**
     * @return Collection<int, Product>
     */
    private function fetchRelatedProducts(Product $product): Collection
    {
        return $product->category
            ->products()
            ->whereNot('id', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }
}
