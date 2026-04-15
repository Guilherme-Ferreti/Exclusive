<?php

declare(strict_types=1);

namespace App\Data\Inertia;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript(name: 'Cart')]
#[MapInputName(SnakeCaseMapper::class)]
final class CartData extends Data
{
    #[Computed]
    public int $subtotal;

    #[Computed]
    public int $shippingCosts;

    #[Computed]
    public int $total;

    public function __construct(
        /** @var array<CartItemData> */
        public Collection $items,
    ) {
        $this->subtotal = $this->items->sum(fn (CartItemData $item) => $item->product->currentPrice * $item->quantity);

        $this->shippingCosts = 0;

        $this->total = $this->subtotal + $this->shippingCosts;
    }
}
