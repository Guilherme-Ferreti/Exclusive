<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertSame;

it('successfully adds a product to the wishlist', function () {
    $user    = User::factory()->create();
    $product = Product::factory()->create();

    actingAs($user)
        ->post(
            uri: route('account.wishlist.toggle'),
            data: ['productId' => $product->id]
        )
        ->assertRedirectBack();

    assertCount(1, $user->wishlist);
    assertSame($product->id, $user->wishlist->first()->id);
});

it('successfully removes a product from the wishlist', function () {
    $user    = User::factory()->create();
    $product = Product::factory()->create();

    $user->wishlist()->attach($product->id);

    actingAs($user)
        ->post(
            uri: route('account.wishlist.toggle'),
            data: ['productId' => $product->id]
        )
        ->assertRedirectBack();

    assertCount(0, $user->wishlist);
});
