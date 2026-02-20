<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Product;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('successfully loads the home page', function () {
    $featuredCategories = Category::factory(6)->featured()->create();
    $featuredProducts   = Product::factory(10)->create();

    get(route('home'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Home')
            ->has('featuredCategories', 6, fn (Assert $page) => $page
                ->has('id')
                ->has('name')
                ->has('slug')
            )
            ->has('featuredProducts', 10, fn (Assert $page) => $page
                ->has('id')
                ->has('name')
                ->has('previewImage')
                ->has('currentPrice')
            )
        );
});
