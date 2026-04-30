<?php

declare(strict_types=1);

namespace App\Storefront\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Shared\Models\Product;

final class ListProducts
{
    /**
     * @return LengthAwarePaginator<int, Product>
     */
    public function handle(?string $search = null, ?string $categoryId = null): LengthAwarePaginator
    {
        return Product::query()
            ->when($search, fn (Builder $q) => $q->where('name', 'like', "%{$search}%"))
            ->when($categoryId, fn (Builder $q) => $q->where('category_id', $categoryId))
            ->paginate(
                perPage: 16,
                columns: ['id', 'name', 'preview_image', 'detail_image', 'current_price']
            );
    }
}
