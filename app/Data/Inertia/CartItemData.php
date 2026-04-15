<?php

declare(strict_types=1);

namespace App\Data\Inertia;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript(name: 'CartItem')]
#[MapInputName(SnakeCaseMapper::class)]
final class CartItemData extends Data
{
    #[Computed]
    public int $subtotal;

    public function __construct(
        public string $id,
        public int $quantity,
        public ProductPreviewData $product,
    ) {
        $this->subtotal = $this->product->currentPrice * $this->quantity;
    }
}
