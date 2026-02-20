<?php

declare(strict_types=1);

namespace App\Data\Inertia;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript(name: 'ProductPreview')]
#[MapInputName(SnakeCaseMapper::class)]
final class ProductPreviewData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $previewImage,
        public int $currentPrice,
    ) {}
}
