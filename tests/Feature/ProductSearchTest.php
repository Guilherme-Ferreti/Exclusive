<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Product;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('successfully loads the search page', function () {
    Category::factory(3)->create();

    get(route('products.search'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Product/Search')
            ->has('categories', 3)
            ->has('products.data', 0)
        );
});

it('displays products matching the search query', function () {
    $category = Category::factory()->create();

    $product1 = Product::factory()->create([
        'name'        => 'Super Widget',
        'category_id' => $category->id,
    ]);

    $product2 = Product::factory()->create([
        'name'        => 'Regular Gadget',
        'category_id' => $category->id,
    ]);

    get(route('products.search', ['q' => 'widget']))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->has('products.data', 1)
            ->where('products.data.0.id', $product1->id)
        );
});

it('filters products by category', function () {
    $category1 = Category::factory()->create(['name' => 'Electronics']);
    $category2 = Category::factory()->create(['name' => 'Clothing']);

    $product1 = Product::factory()->create([
        'name'        => 'Phone',
        'category_id' => $category1->id,
    ]);

    $product2 = Product::factory()->create([
        'name'        => 'Shirt',
        'category_id' => $category2->id,
    ]);

    get(route('products.search', ['category' => $category1->id]))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->has('products.data', 1)
            ->where('products.data.0.id', $product1->id)
        );
});
