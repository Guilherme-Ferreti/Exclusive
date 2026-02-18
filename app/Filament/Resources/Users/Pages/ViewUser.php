<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

final class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('name'),

            TextEntry::make('email'),

            TextEntry::make('address'),

            TextEntry::make('email_verified_at')
                ->label('Email Verified')
                ->dateTime(),

            TextEntry::make('created_at')
                ->label('Created At')
                ->dateTime(),
        ]);
    }
}
