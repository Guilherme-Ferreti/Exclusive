<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Products\Pages;

use App\Admin\Actions\StoreProduct\StoreProduct;
use App\Admin\Actions\StoreProduct\StoreProductData;
use App\Admin\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Shared\Models\Product;

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
        return app(StoreProduct::class)->handle(new StoreProductData(...$data));
    }
}
