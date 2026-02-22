<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Pages;

use App\Actions\UpdateProduct;
use App\Data\Actions\UpdateProductData;
use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

final class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    /**
     * @param  Product  $record
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(UpdateProduct::class)->handle($record, UpdateProductData::from($data));
    }
}
