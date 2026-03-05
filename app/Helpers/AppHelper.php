<?php

declare(strict_types=1);

namespace App\Helpers;

final class AppHelper
{
    public static function getDefaultProductPreviewImage(string $productName): string
    {
        return 'https://placehold.co/245x337?text=' . urlencode($productName);
    }

    public static function getDefaultProductDetailImage(string $productName): string
    {
        return 'https://placehold.co/534x735?text=' . urlencode($productName);
    }
}
