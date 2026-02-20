<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\CacheKey;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

final class ListFeaturedCategories
{
    public function handle(): Collection
    {
        return cache()->rememberForever(
            key: CacheKey::FEATURED_CATEGORIES,
            callback: fn () => $this->fetchFeaturedCategories()
        );
    }

    private function fetchFeaturedCategories(): Collection
    {
        return Category::query()
            ->featured()
            ->get(['id', 'name', 'slug']);
    }
}
