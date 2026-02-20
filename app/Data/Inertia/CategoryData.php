<?php

declare(strict_types=1);

namespace App\Data\Inertia;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript(name: 'Category')]
final class CategoryData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $slug,
    ) {}
}
