<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Forms\Components\PreviewableImageURL;
use App\Rules\ValidImageUrl;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                PreviewableImageURL::make('preview_image')
                    ->name('Preview Image')
                    ->nullable()
                    ->string()
                    ->rule(new ValidImageUrl),

                PreviewableImageURL::make('detail_image')
                    ->nullable()
                    ->string()
                    ->rule(new ValidImageUrl),
            ]);
    }
}
