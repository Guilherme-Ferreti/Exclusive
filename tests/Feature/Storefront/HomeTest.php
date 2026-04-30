<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia as Assert;
use Shared\Models\Category;
use Shared\Models\Product;

use function Pest\Laravel\get;

it('loads the home page', function () {
    $featuredCategories = Category::factory(6)->featured()->create();
    $featuredProducts   = Product::factory(10)->create();

    get(route('storefront.home'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Storefront/Home')
            ->has('featuredCategories', 6, fn (Assert $page) => $page
                ->has('id')
                ->has('name')
            )
            ->has('featuredProducts', 10, fn (Assert $page) => $page
                ->has('id')
                ->has('name')
                ->has('previewImage')
                ->has('detailImage')
                ->has('currentPrice')
            )
            ->has('bestSellingProducts', 4, fn (Assert $page) => $page
                ->has('id')
                ->has('name')
                ->has('previewImage')
                ->has('detailImage')
                ->has('currentPrice')
            )
        );
});
