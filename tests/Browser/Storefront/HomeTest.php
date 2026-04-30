<?php

declare(strict_types=1);

use Shared\Models\Category;
use Shared\Models\Product;

it('renders the home page', function () {
    $featuredCategories = Category::factory(6)->featured()->create();
    $featuredProducts   = Product::factory(10)->create();

    visit(route('storefront.home'))
        ->assertNoSmoke();
});
