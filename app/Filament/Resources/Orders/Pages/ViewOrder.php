<?php

declare(strict_types=1);

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

final class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('number'),

            TextEntry::make('user.name')
                ->label('Customer'),

            TextEntry::make('status')
                ->badge(),

            TextEntry::make('total')
                ->money('usd')
                ->state(fn (Order $record) => $record->total / 100),

            TextEntry::make('created_at')
                ->label('Created At')
                ->dateTime(),

            RepeatableEntry::make('items')
                ->columnSpanFull()
                ->table([
                    TableColumn::make('Product'),
                    TableColumn::make('Category'),
                    TableColumn::make('Quantity'),
                    TableColumn::make('Unit Price'),
                ])
                ->schema([
                    TextEntry::make('product.name'),
                    TextEntry::make('product.category.name'),
                    TextEntry::make('quantity'),
                    TextEntry::make('unit_price')
                        ->money('usd')
                        ->state(fn (OrderItem $record) => $record->unit_price / 100),
                ]),
        ]);
    }
}
