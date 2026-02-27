<?php

declare(strict_types=1);

use App\Actions\StoreProduct;
use App\Data\Actions\StoreProductData;
use App\Models\Category;
use App\Models\Price;
use App\Models\Product;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('successfully creates a product', function () {
    $data = new StoreProductData(
        name: 'Test Product',
        description: 'This is a test product.',
        preview_image: 'https://example.com/preview.jpg',
        detail_image: 'https://example.com/detail.jpg',
        current_price: 9999,
        category_id: Category::factory()->create()->id,
    );

    $product = app(StoreProduct::class)->handle($data);

    assertDatabaseHas(Product::class, [
        'id'            => $product->id,
        'name'          => $data->name,
        'description'   => $data->description,
        'preview_image' => $data->preview_image,
        'detail_image'  => $data->detail_image,
        'current_price' => $data->current_price,
        'category_id'   => $data->category_id,
    ]);

    assertDatabaseCount(Price::class, 1);
    assertDatabaseHas(Price::class, [
        'product_id' => $product->id,
        'price'      => $data->current_price,
        'ended_at'   => null,
    ]);
});
