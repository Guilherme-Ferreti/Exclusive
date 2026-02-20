<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ListBestSellingProducts;
use App\Actions\ListFeaturedCategories;
use App\Actions\ListFeaturedProducts;
use App\Data\Inertia\CategoryData;
use App\Data\Inertia\ProductPreviewData;
use Inertia\Response;

final class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $featuredCategories  = app(ListFeaturedCategories::class)->handle();
        $featuredProducts    = app(ListFeaturedProducts::class)->handle();
        $bestSellingProducts = app(ListBestSellingProducts::class)->handle();

        return inertia('Home', [
            'featuredCategories'  => CategoryData::collect($featuredCategories),
            'featuredProducts'    => ProductPreviewData::collect($featuredProducts),
            'bestSellingProducts' => ProductPreviewData::collect($bestSellingProducts),
        ]);
    }
}
