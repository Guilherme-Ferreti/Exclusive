<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\ToastType;
use Inertia\Inertia;
use Inertia\ResponseFactory;

final class ToastHelper
{
    public static function toast(ToastType $type, string $message): ResponseFactory
    {
        return Inertia::flash('toast', [
            'type'    => $type->value,
            'message' => $message,
        ]);
    }

    public static function success(string $message): ResponseFactory
    {
        return self::toast(ToastType::SUCCESS, $message);
    }
}
