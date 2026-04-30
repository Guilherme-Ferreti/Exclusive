<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Orders\Tables;

use App\Admin\Filament\Resources\Orders\OrderResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Shared\Enums\OrderStatus;
use Shared\Models\Order;

final class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(Order::with('user'))
            ->columns([
                TextColumn::make('number')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => OrderStatus::PENDING,
                        'info'    => OrderStatus::SHIPPED,
                        'success' => OrderStatus::DELIVERED,
                    ]),

                TextColumn::make('total')
                    ->money('usd')
                    ->state(fn (Order $record) => $record->total / 100)
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record])),

                Action::make('updateStatus')
                    ->label('Update Status')
                    ->icon(Heroicon::OutlinedPencilSquare)
                    ->modalHeading('Update Order Status')
                    ->modalSubmitActionLabel('Update')
                    ->fillForm(fn (Order $record): array => [
                        'status' => $record->status,
                    ])
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                OrderStatus::PENDING->value   => 'Pending',
                                OrderStatus::SHIPPED->value   => 'Shipped',
                                OrderStatus::DELIVERED->value => 'Delivered',
                            ])
                            ->required(),
                    ])
                    ->action(function (Order $record, array $data): void {
                        $record->update([
                            'status' => $data['status'],
                        ]);

                        Notification::make()
                            ->title('Order status updated')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
