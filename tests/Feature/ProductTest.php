<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Product;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('successfully loads the show product page', function () {
    $category = Category::factory()->has(Product::factory(5))->create();
    $product  = $category->products()->first();

    get(route('products.show', $product))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Product/Show')
            ->has('product', fn (Assert $page) => $page
                ->where('id', $product->id)
                ->where('name', $product->name)
                ->where('description', $product->description)
                ->where('detailImage', $product->detail_image)
                ->where('currentPrice', $product->current_price)
                ->has('category')
                ->etc()
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
