<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;

final class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getTabs(): array
    {
        return [
            'users' => Tab::make()
                ->icon(Heroicon::Users)
                ->modifyQueryUsing(fn (Builder $query) => $query->notAdmin()), /** @phpstan-ignore-line */
            'admins' => Tab::make()
                ->icon(Heroicon::ShieldCheck)
                ->modifyQueryUsing(fn (Builder $query) => $query->admin()), /** @phpstan-ignore-line */
        ];
    }
}
