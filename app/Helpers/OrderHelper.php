<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;

final class OrderHelper
{
    public static function generateNumber(): string
    {
        return 'ORD-' . strtoupper(Str::random(8));
    }
}
