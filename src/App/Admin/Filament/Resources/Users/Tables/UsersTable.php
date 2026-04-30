<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Users\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Shared\Models\User;

final class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime(),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
