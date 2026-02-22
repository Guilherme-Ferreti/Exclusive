<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Actions\StoreProductData;
use App\Models\Product;

final class StoreProduct
{
    public function handle(StoreProductData $data): Product
    {
        $product = Product::create([
            'name'          => $data->name,
            'preview_image' => $data->preview_image,
            'detail_image'  => $data->detail_image,
            'current_price' => $data->current_price,
            'category_id'   => $data->category_id,
        ]);

        $product->prices()->create([
            'price'      => $data->current_price,
            'started_at' => now(),
        ]);

        return $product;
    }
}
