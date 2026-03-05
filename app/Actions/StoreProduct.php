<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Actions\StoreProductData;
use App\Helpers\AppHelper;
use App\Models\Product;

final class StoreProduct
{
    public function handle(StoreProductData $data): Product
    {
        $data->preview_image = $data->preview_image ?? AppHelper::getDefaultProductPreviewImage($data->name);
        $data->detail_image  = $data->detail_image ?? AppHelper::getDefaultProductDetailImage($data->name);

        $product = Product::create($data->toArray());

        $product->prices()->create([
            'price'      => $data->current_price,
            'started_at' => now(),
        ]);

        return $product;
    }
}
