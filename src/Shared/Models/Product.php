<?php

declare(strict_types=1);

namespace Shared\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $preview_image
 * @property string $detail_image
 * @property int $current_price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $category_id
 * @property-read Category $category
 * @property-read Collection<int, User> $wishlisted_by
 * @property-read Collection<int, Price> $prices
 * @property-read ?int $order_items_sum_quantity
 */
#[Unguarded]
final class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasUuids;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'current_price' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function wishlistedBy(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'wishlists')
            ->withTimestamps();
    }

    /**
     * @return HasMany<OrderItem, $this>
     */
    public function orderItems(): HasMany
    {
        return $this->HasMany(OrderItem::class);
    }

    /**
     * @return HasMany<Price, $this>
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    /**
     * @return HasOne<Price, $this>
     */
    public function currentPrice(): HasOne
    {
        return $this->hasOne(Price::class)->current(); /** @phpstan-ignore-line */
    }
}
