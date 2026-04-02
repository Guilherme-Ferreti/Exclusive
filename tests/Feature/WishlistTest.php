<?php

declare(strict_types=1);

use App\Actions\ToggleWishlistedProduct;
use App\Models\Product;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;

it('successfully loads the wishlist page', function () {
    $user    = User::factory()->create();
    $product = Product::factory()->create();

    app(ToggleWishlistedProduct::class)->handle($user, $product->id);

    actingAs($user)
        ->get(route('account.wishlist'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Account/Wishlist')
            ->has('products', 1, fn (Assert $page) => $page
                ->where('id', $product->id)
                ->etc()
            )
        );
});
