<?php

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

final class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Orders')
                ->modifyQueryUsing(fn (Builder $query) => $query),

            'pending' => Tab::make('Pending')
                ->badge(fn () => Order::query()->where('status', OrderStatus::PENDING)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::PENDING)),

            'shipped' => Tab::make('Shipped')
                ->badge(fn () => Order::query()->where('status', OrderStatus::SHIPPED)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::SHIPPED)),

            'delivered' => Tab::make('Delivered')
                ->badge(fn () => Order::query()->where('status', OrderStatus::DELIVERED)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatus::DELIVERED)),
        ];
    }
}
