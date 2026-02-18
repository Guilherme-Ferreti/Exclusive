<?php

declare(strict_types=1);

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUlids, Notifiable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'address',
        'password',
        'is_admin',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name'              => 'string',
            'email'             => 'string',
            'email_verified_at' => 'datetime',
            'address'           => 'string',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
        ];
    }

    /**
     * @return BelongsToMany<Product, $this>
     */
    public function wishlist(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'wishlists')
            ->withTimestamps();
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
