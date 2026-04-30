<?php

declare(strict_types=1);

namespace App\Admin\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Shared\Models\Category;
use Shared\Models\Order;
use Shared\Models\Product;
use Shared\Models\User;

final class StatsOverviewWidget extends BaseWidget
{
    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';

    protected function getStats(): array
    {
        return [
            Stat::make('Products', Product::count()),

            Stat::make('Categories', Category::count()),

            Stat::make('Users', User::count()),

            Stat::make('Orders', Order::count()),
        ];
    }
}
