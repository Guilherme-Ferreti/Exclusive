<?php

declare(strict_types=1);

namespace Shared\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property int $price
 * @property Carbon $started_at
 * @property ?Carbon $ended_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $product_id
 * @property-read Product $product
 */
#[Unguarded]
final class Price extends Model
{
    /** @use HasFactory<\Database\Factories\PriceFactory> */
    use HasFactory, HasUuids;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price'      => 'integer',
            'started_at' => 'datetime',
            'ended_at'   => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param  Builder<$this>  $query
     */
    #[Scope]
    public function current(Builder $query): Builder
    {
        return $query->whereNull('ended_at');
    }
}
