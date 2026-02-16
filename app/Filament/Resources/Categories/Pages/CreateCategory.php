<?php

declare(strict_types=1);

namespace App\Filament\Resources\Categories\Pages;

use App\Enums\CacheKey;
use App\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;

final class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function afterCreate(): void
    {
        Cache::forget(CacheKey::FEATURED_CATEGORIES);
    }
}
