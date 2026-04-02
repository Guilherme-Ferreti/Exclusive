<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Pages;

use App\Actions\Admin\StoreProduct;
use App\Data\Actions\Admin\StoreProductData;
use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Resources\Pages\CreateRecord;

final class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function handleRecordCreation(array $data): Product
    {
        return app(StoreProduct::class)->handle(StoreProductData::from($data));
    }
}
