<?php

declare(strict_types=1);

use Shared\Models\Product;

it('renders the list products page', function () {
    Product::factory(10)->create();

    visit(route('storefront.products.index'))
        ->assertNoSmoke();
});

it('renders the show product page', function () {
    $product = Product::factory()->create();

    visit(route('storefront.products.show', $product))
        ->assertNoSmoke();
});
