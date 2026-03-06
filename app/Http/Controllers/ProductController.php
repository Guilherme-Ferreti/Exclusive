<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ListRelatedProducts;
use App\Data\Inertia\ProductPreviewData;
use App\Data\Inertia\ProductShowData;
use App\Models\Product;
use Inertia\Response;

final class ProductController extends Controller
{
    public function show(Product $product): Response
    {
        $product->load('category');

        $relatedProducts = app(ListRelatedProducts::class)->handle($product);

        return inertia('Product/Show', [
            'product'         => ProductShowData::from($product),
            'relatedProducts' => ProductPreviewData::collect($relatedProducts),
        ]);
    }
}
