<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Users;

use App\Admin\Filament\Resources\Users\Pages\ListUsers;
use App\Admin\Filament\Resources\Users\Pages\ViewUser;
use App\Admin\Filament\Resources\Users\Tables\UsersTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Shared\Models\User;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Users';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema;
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'view'  => ViewUser::route('/{record}'),
        ];
    }
}
