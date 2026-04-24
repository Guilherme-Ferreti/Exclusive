<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

final class SearchProducts
{
    public function handle(string $query, ?string $categoryId = null): LengthAwarePaginator
    {
        return Product::query()
            ->whereLike('name', "%{$query}%")
            ->when($categoryId, fn (Builder $q) => $q->where('category_id', $categoryId))
            ->paginate(
                perPage: 10,
                columns: ['id', 'name', 'preview_image', 'detail_image', 'current_price']
            );
    }
}
