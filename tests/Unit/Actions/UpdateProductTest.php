<?php

declare(strict_types=1);

use App\Actions\Admin\UpdateProduct;
use App\Data\Actions\Admin\UpdateProductData;
use App\Models\Category;
use App\Models\Price;
use App\Models\Product;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('successfully updates a product', function () {
    $this->freezeTime();

    $product       = Product::factory()->create();
    $originalPrice = $product->current_price;

    $data = new UpdateProductData(
        name: 'Updated Product Name',
        description: 'Updated description.',
        preview_image: 'https://example.com/new-preview.jpg',
        detail_image: 'https://example.com/new-detail.jpg',
        current_price: $originalPrice * 2,
        category_id: Category::factory()->create()->id,
    );

    app(UpdateProduct::class)->handle($product, $data);

    assertDatabaseHas(Product::class, [
        'id'            => $product->id,
        'name'          => $data->name,
        'description'   => $data->description,
        'preview_image' => $data->preview_image,
        'detail_image'  => $data->detail_image,
        'current_price' => $data->current_price,
        'category_id'   => $data->category_id,
    ]);

    assertDatabaseCount(Price::class, 2);
    assertDatabaseHas(Price::class, [
        'product_id' => $product->id,
        'price'      => $originalPrice,
        'ended_at'   => now(),
    ]);
    assertDatabaseHas(Price::class, [
        'product_id' => $product->id,
        'price'      => $data->current_price,
        'ended_at'   => null,
    ]);
});

it('does not create a new price when price is unchanged', function () {
    $product = Product::factory()->create();

    $data = new UpdateProductData(
        name: 'Updated Product Name',
        description: 'Updated description.',
        preview_image: 'https://example.com/new-preview.jpg',
        detail_image: 'https://example.com/new-detail.jpg',
        current_price: $product->current_price,
        category_id: Category::factory()->create()->id,
    );

    app(UpdateProduct::class)->handle($product, $data);

    assertDatabaseCount(Price::class, 1);
});
