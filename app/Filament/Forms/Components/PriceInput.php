<?php

declare(strict_types=1);

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\TextInput;
use Filament\Support\RawJs;

final class PriceInput extends TextInput
{
    protected bool $convertToCents = false;

    protected int $divisor = 100;

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->prefix('$')
            ->numeric()
            ->inputMode('decimal')
            ->mask(RawJs::make('$money($input)'))
            ->stripCharacters(',')
            ->formatStateUsing(
                fn (int|float|null $state) => $this->convertToCents && is_numeric($state) ? (float) ($state / $this->divisor) : $state
            )
            ->dehydrateStateUsing(fn (?float $state) => $this->convertToCents && is_numeric($state) ? (int) round((float) $state * $this->divisor) : $state);
    }

    public function convertToCents(bool $condition = true): static
    {
        $this->convertToCents = $condition;

        return $this;
    }
}
