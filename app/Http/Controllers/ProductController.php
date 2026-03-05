<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\Inertia\ProductShowData;
use App\Models\Product;

final class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load('category');

        return inertia('Product/Show', [
            'product' => ProductShowData::from($product),
        ]);
    }
}
