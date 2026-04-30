<?php

declare(strict_types=1);

namespace Shared\Enums;

enum CacheKey: string
{
    case FEATURED_CATEGORIES = 'featured_categories';

    case FEATURED_PRODUCTS = 'featured_products';

    case BEST_SELLING_PRODUCTS = 'best_selling_products';

    public static function wishlist(string $userId): string
    {
        return "wishlist.$userId";
    }

    public static function cartItems(string $userId): string
    {
        return "cart_items.$userId";
    }
}
