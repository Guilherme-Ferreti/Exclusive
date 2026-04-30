<?php

declare(strict_types=1);

namespace App\Storefront\Controllers;

use App\Storefront\Actions\ListProducts;
use App\Storefront\Actions\ListRelatedProducts;
use App\Storefront\Resources\ProductShowResource;
use Inertia\Response;
use Shared\Base\Controller;
use Shared\Models\Category;
use Shared\Models\Product;
use Shared\Resources\CategoryPreviewResource;
use Shared\Resources\ProductPreviewResource;

final class ProductController extends Controller
{
    public function index(): Response
    {
        $products = app(ListProducts::class)->handle(
            search: request()->query('search'),
            categoryId: request()->query('category'),
        );

        $categories = Category::all();

        return inertia('Storefront/Product/Index', [
            'products'   => inertia()->scroll(ProductPreviewResource::collection($products)),
            'categories' => CategoryPreviewResource::collection($categories),
        ]);
    }

    public function show(Product $product): Response
    {
        $relatedProducts = app(ListRelatedProducts::class)->handle($product);

        return inertia('Storefront/Product/Show', [
            'product'         => new ProductShowResource($product),
            'relatedProducts' => ProductPreviewResource::collection($relatedProducts),
        ]);
    }
}
