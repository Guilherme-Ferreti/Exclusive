<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Actions\StoreProductData;
use App\Models\Product;

final class StoreProduct
{
    public function handle(StoreProductData $data): Product
    {
        $product = Product::create($data->toArray());

        $product->prices()->create([
            'price'      => $data->current_price,
            'started_at' => now(),
        ]);

        return $product;
    }
}
