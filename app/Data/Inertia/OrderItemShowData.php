<?php

declare(strict_types=1);

namespace App\Data\Inertia;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript(name: 'OrderItemShow')]
#[MapInputName(SnakeCaseMapper::class)]
final class OrderItemShowData extends Data
{
    #[Computed]
    public int $subtotal;

    public function __construct(
        public string $id,
        public int $quantity,
        public int $unitPrice,
        public ProductPreviewData $product,
    ) {
        $this->subtotal = $this->unitPrice * $this->quantity;
    }
}
