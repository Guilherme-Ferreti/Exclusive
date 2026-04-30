<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Categories\Pages;

use App\Admin\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;
use Shared\Enums\CacheKey;

final class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        Cache::forget(CacheKey::FEATURED_CATEGORIES);
    }
}
