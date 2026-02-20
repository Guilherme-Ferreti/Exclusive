<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\CacheKey;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

final class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $featuredCategories = Cache::rememberForever(
            key: CacheKey::FEATURED_CATEGORIES,
            callback: fn () => Category::query()
                ->featured()
                ->get(['id', 'name', 'slug'])
        );

        $featuredProducts = Cache::remember(
            key: CacheKey::FEATURED_PRODUCTS,
            ttl: now()->endOfDay(),
            callback: fn () => Product::query()
                ->inRandomOrder()
                ->whereNotNull('preview_image')
                ->take(10)
                ->get(['id', 'name', 'preview_image', 'current_price'])
        );

        $bestSellingProducts = Cache::remember(
            key: CacheKey::BEST_SELLING_PRODUCTS,
            ttl: now()->endOfDay(),
            callback: fn () => Product::query()
                ->inRandomOrder()
                ->take(4)
                ->get(['id', 'name', 'preview_image'])
        );

        return Inertia::render('Home', compact('featuredCategories', 'featuredProducts', 'bestSellingProducts'));
    }
}
