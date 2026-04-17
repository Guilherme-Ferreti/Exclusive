<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING   = 'pending';
    case SHIPPED   = 'shipped';
    case DELIVERED = 'delivered';

    public function color(): BadgeColor
    {
        return match ($this) {
            self::PENDING   => BadgeColor::YELLOW,
            self::SHIPPED   => BadgeColor::BLUE,
            self::DELIVERED => BadgeColor::GREEN,
        };
    }
}
