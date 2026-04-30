<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia as Assert;
use Shared\Models\Category;
use Shared\Models\Product;

use function Pest\Laravel\get;

it('loads the list products page', function () {
    $categories = Category::factory(3)->create();
    $products   = Product::factory(10)->recycle($categories)->create();

    get(route('storefront.products.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Storefront/Product/Index')
            ->has('categories', 3, fn (Assert $page) => $page
                ->has('id')
                ->has('name')
            )
            ->has('products.data', 10, fn (Assert $page) => $page
                ->has('id')
                ->has('name')
                ->has('previewImage')
                ->has('detailImage')
                ->has('currentPrice')
            )
        );
});

it('lists products matching the search query', function () {
    $products = Product::factory(2)
        ->sequence(
            ['name' => 'Widget'],
            ['name' => 'Gadget'],
        )
        ->create();

    get(route('storefront.products.index', ['search' => 'widget']))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->has('products.data', 1)
            ->where('products.data.0.id', $products[0]->id)
        );
});

it('lists products filtered by category', function () {
    $productA = Product::factory()->create();
    $productB = Product::factory()->create();

    get(route('storefront.products.index', ['category' => $productA->category_id]))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->has('products.data', 1)
            ->where('products.data.0.id', $productA->id)
        );
});

it('loads the show product page', function () {
    $category = Category::factory()->has(Product::factory(5))->create();
    $product  = $category->products()->first();

    get(route('storefront.products.show', $product))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Storefront/Product/Show')
            ->has('product', fn (Assert $page) => $page
                ->where('id', $product->id)
                ->has('name')
                ->has('description')
                ->has('detailImage')
                ->has('currentPrice')
                ->has('category', fn (Assert $page) => $page
                    ->where('id', $product->category_id)
                    ->has('name')
                )
            )
            ->has('relatedProducts', 4, fn (Assert $page) => $page
                ->has('id')
                ->has('name')
                ->has('previewImage')
                ->has('detailImage')
                ->has('currentPrice')
            )
        );
});
