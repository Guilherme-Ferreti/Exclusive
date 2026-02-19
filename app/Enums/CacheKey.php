<?php

declare(strict_types=1);

namespace App\Enums;

enum CacheKey: string
{
    case FEATURED_CATEGORIES = 'featured_categories';

    case FEATURED_PRODUCTS = 'featured_products';

    case BEST_SELLING_PRODUCTS = 'best_selling_products';
}
