<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Categories;

use App\Admin\Filament\Resources\Categories\Pages\CreateCategory;
use App\Admin\Filament\Resources\Categories\Pages\EditCategory;
use App\Admin\Filament\Resources\Categories\Pages\ListCategories;
use App\Admin\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Admin\Filament\Resources\Categories\Tables\CategoriesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Shared\Models\Category;

final class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $navigationLabel = 'Categories';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit'   => EditCategory::route('/{record}/edit'),
        ];
    }
}
