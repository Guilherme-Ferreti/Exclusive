<?php

declare(strict_types=1);

use App\Storefront\Actions\ListBestSellingProducts;
use Shared\Models\OrderItem;
use Shared\Models\Product;

it('lists best selling products', function () {
    $products = Product::factory(4)->create();

    OrderItem::factory()->for($products[0])->create(['quantity' => 10]);
    OrderItem::factory()->for($products[1])->create(['quantity' => 9]);
    OrderItem::factory()->for($products[2])->create(['quantity' => 8]);
    OrderItem::factory()->for($products[3])->create(['quantity' => 7]);

    OrderItem::factory(10)->create(['quantity' => 6]);

    $bestSellingProducts = app(ListBestSellingProducts::class)->handle();

    $bestSellingIds = $bestSellingProducts->pluck('id')->toArray();

    expect($bestSellingIds)->toHaveCount(4);
    expect($bestSellingIds)->toContain($products[0]->id);
    expect($bestSellingIds)->toContain($products[1]->id);
    expect($bestSellingIds)->toContain($products[2]->id);
    expect($bestSellingIds)->toContain($products[3]->id);
});
