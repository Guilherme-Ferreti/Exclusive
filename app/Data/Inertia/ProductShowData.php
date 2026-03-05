<?php

declare(strict_types=1);

namespace App\Data\Inertia;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript(name: 'ProductShow')]
#[MapInputName(SnakeCaseMapper::class)]
final class ProductShowData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $description,
        public int $currentPrice,
        public string $detailImage,
        public CategoryData $category,
    ) {}
}
