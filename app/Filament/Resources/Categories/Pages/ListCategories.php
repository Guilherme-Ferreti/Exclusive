<?php

declare(strict_types=1);

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

final class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all'      => Tab::make('All'),
            'featured' => Tab::make('Featured')
                ->modifyQueryUsing(fn (Builder $query) => $query->featured()), /** @phpstan-ignore-line */
        ];
    }
}
