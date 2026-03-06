<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasUuids;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'preview_image',
        'detail_image',
        'current_price',
        'category_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name'          => 'string',
            'description'   => 'string',
            'preview_image' => 'string',
            'detail_image'  => 'string',
            'current_price' => 'integer',
            'category_id'   => 'string',
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
