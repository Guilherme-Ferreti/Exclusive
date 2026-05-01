<?php

declare(strict_types=1);

namespace App\Storefront\Controllers;

use App\Storefront\Actions\ListBestSellingProducts;
use App\Storefront\Actions\ListFeaturedCategories;
use App\Storefront\Actions\ListFeaturedProducts;
use Inertia\Response;
use Shared\Base\Controller;
use Shared\Resources\CategoryPreviewResource;
use Shared\Resources\ProductBestSellingResource;
use Shared\Resources\ProductPreviewResource;

final class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $featuredCategories  = app(ListFeaturedCategories::class)->handle();
        $featuredProducts    = app(ListFeaturedProducts::class)->handle();
        $bestSellingProducts = app(ListBestSellingProducts::class)->handle();

        return inertia('Storefront/Home', [
            'featuredCategories'  => CategoryPreviewResource::collection($featuredCategories),
            'featuredProducts'    => ProductPreviewResource::collection($featuredProducts),
            'bestSellingProducts' => ProductBestSellingResource::collection($bestSellingProducts),
        ]);
    }
}
