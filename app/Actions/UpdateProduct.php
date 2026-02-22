<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\Actions\UpdateProductData;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

final class UpdateProduct
{
    public function handle(Product $product, UpdateProductData $data): Product
    {
        DB::transaction(function () use ($product, $data) {
            $product->fill($data->toArray());

            $this->createNewPriceRecordIfPriceHasChanged($product, $data);

            $product->save();
        });

        return $product;
    }

    private function createNewPriceRecordIfPriceHasChanged(Product $product, UpdateProductData $data): void
    {
        if (! $product->isDirty('current_price')) {
            return;
        }

        $product->prices()->current()->update([/** @phpstan-ignore-line */
            'ended_at' => now(),
        ]);

        $product->prices()->create([
            'price'      => $data->current_price,
            'started_at' => now(),
        ]);
    }
}
