<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
