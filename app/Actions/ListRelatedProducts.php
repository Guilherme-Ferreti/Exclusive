<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

final class ListRelatedProducts
{
    public function handle(Product $product): Collection
    {
        return cache()->remember(
            key: "products.{$product->id}.related",
            ttl: now()->endOfDay(),
            callback: fn () => $this->fetchRelatedProducts($product)
        );
    }

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
