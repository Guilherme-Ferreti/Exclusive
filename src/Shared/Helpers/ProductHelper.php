<?php

declare(strict_types=1);

namespace Shared\Helpers;

final class ProductHelper
{
    public static function getDefaultPreviewImage(string $productName): string
    {
        return 'https://placehold.co/245x337?text=' . urlencode($productName);
    }

    public static function getDefaultDetailImage(string $productName): string
    {
        return 'https://placehold.co/534x735?text=' . urlencode($productName);
    }
}
