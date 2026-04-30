<?php

declare(strict_types=1);

namespace App\Admin\Filament\Resources\Products\Schemas;

use App\Admin\Filament\Forms\Components\PreviewableImageURLInput;
use App\Admin\Filament\Forms\Components\PriceInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Shared\Rules\ValidImageUrl;

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

                PriceInput::make('current_price')
                    ->convertToCents()
                    ->required(),

                Textarea::make('description')
                    ->nullable()
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Fieldset::make('images')
                    ->label('Images')
                    ->schema([
                        PreviewableImageURLInput::make('preview_image')
                            ->nullable(fn (string $operation) => $operation === 'create')
                            ->string()
                            ->rule(new ValidImageUrl),

                        PreviewableImageURLInput::make('detail_image')
                            ->nullable(fn (string $operation) => $operation === 'create')
                            ->string()
                            ->rule(new ValidImageUrl),
                    ])
                    ->columnSpanFull()
                    ->columns(2),
            ]);
    }
}
