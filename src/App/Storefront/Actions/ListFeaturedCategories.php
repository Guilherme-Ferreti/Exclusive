<?php

declare(strict_types=1);

namespace App\Storefront\Actions;

use Illuminate\Support\Collection;
use Shared\Enums\CacheKey;
use Shared\Models\Category;

final class ListFeaturedCategories
{
    /**
     * @return Collection<int, Category>
     */
    public function handle(): Collection
    {
        return cache()->rememberForever(
            key: CacheKey::FEATURED_CATEGORIES,
            callback: fn () => $this->fetchFeaturedCategories()
        );
    }

    /**
     * @return Collection<int, Category>
     */
    private function fetchFeaturedCategories(): Collection
    {
        return Category::query()
            ->featured()
            ->get(['id', 'name', 'slug']);
    }
}
