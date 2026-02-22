<?php

declare(strict_types=1);

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Support\Components\Attributes\ExposedLivewireMethod;
use Illuminate\Support\Str;

final class PreviewableImageURLInput extends Field
{
    protected string $view = 'filament.forms.components.previewable-image-url-input';

    #[ExposedLivewireMethod]
    public function isValidImageUrl(): bool
    {
        return Str::isUrl($this->getState()) && Str::endsWith($this->getState(), '.webp');
    }
}
