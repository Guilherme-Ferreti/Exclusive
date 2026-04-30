<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Categories\Pages;

use App\Admin\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;
use Shared\Enums\CacheKey;

final class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function afterCreate(): void
    {
        Cache::forget(CacheKey::FEATURED_CATEGORIES);
    }
}
