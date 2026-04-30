<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Products\Pages;

use App\Admin\Actions\UpdateProduct\UpdateProduct;
use App\Admin\Actions\UpdateProduct\UpdateProductData;
use App\Admin\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Shared\Models\Product;

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
        return app(UpdateProduct::class)->handle($record, new UpdateProductData(...$data));
    }
}
