<?php

declare(strict_types=1);

namespace Shared\Helpers;

use Shared\Enums\ToastType;

final class ToastHelper
{
    public static function toast(ToastType $type, string $message): void
    {
        inertia()->flash('toast', [
            'type'    => $type->value,
            'message' => $message,
        ]);
    }

    public static function success(string $message): void
    {
        self::toast(ToastType::SUCCESS, $message);
    }

    public static function error(string $message): void
    {
        self::toast(ToastType::ERROR, $message);
    }
}
