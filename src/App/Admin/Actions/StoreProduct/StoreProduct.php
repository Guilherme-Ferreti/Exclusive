<?php

declare(strict_types=1);

namespace App\Admin\Actions\StoreProduct;

use Illuminate\Support\Facades\DB;
use Shared\Helpers\ProductHelper;
use Shared\Models\Product;

final class StoreProduct
{
    public function handle(StoreProductData $data): Product
    {
        return DB::transaction(function () use ($data) {
            $data->preview_image = $data->preview_image ?? ProductHelper::getDefaultPreviewImage($data->name);
            $data->detail_image  = $data->detail_image ?? ProductHelper::getDefaultDetailImage($data->name);

            $product = Product::create((array) $data);

            $product->prices()->create([
                'price'      => $data->current_price,
                'started_at' => now(),
            ]);

            return $product;
        });
    }
}
