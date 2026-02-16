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
            key: 'today_featured_products',
            ttl: now()->endOfDay(),
            callback: fn () => Product::query()
                ->inRandomOrder()
                ->whereNotNull('preview_image')
                ->take(10)
                ->get(['id', 'name', 'preview_image'])
        );

        return Inertia::render('Home', compact('featuredCategories', 'featuredProducts'));
    }
}
