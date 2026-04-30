<?php

declare(strict_types=1);

namespace Shared\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property ?Carbon $email_verified_at
 * @property string $address
 * @property bool $is_admin
 * @property string $password
 * @property ?string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, Product> $wishlistItems
 * @property-read ?Cart $cart
 * @property-read Collection<int, Order> $orders
 */
#[Guarded(['is_admin'])]
#[Hidden(['password', 'remember_token'])]
final class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, Notifiable;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
        ];
    }

    /**
     * @return BelongsToMany<Product, $this>
     */
    public function wishlistItems(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'wishlists')
            ->withTimestamps();
    }

    /**
     * @return HasOne<Cart, $this>
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * @return HasMany<Order, $this>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin;
    }

    #[Scope]
    public function admin(Builder $query): Builder
    {
        return $query->where('is_admin', true);
    }

    #[Scope]
    public function notAdmin(Builder $query): Builder
    {
        return $query->where('is_admin', false);
    }
}
