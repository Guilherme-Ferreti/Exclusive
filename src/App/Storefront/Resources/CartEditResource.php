<?php

declare(strict_types=1);

namespace App\Storefront\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Shared\Models\Cart;
use Shared\Models\CartItem;
use Shared\Resources\ProductPreviewResource;

/**
 * @mixin Cart
 */
final class CartEditResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $subtotal      = $this->items->sum(fn (CartItem $item) => $item->product->current_price * $item->quantity);
        $shippingCosts = 0;

        return [
            'subtotal'      => $subtotal,
            'shippingCosts' => $shippingCosts,
            'total'         => $subtotal + $shippingCosts,

            'items' => $this->items->map(fn (CartItem $item) => [
                'id'       => $item->id,
                'quantity' => $item->quantity,
                'subtotal' => $item->product->current_price * $item->quantity,

                'product' => new ProductPreviewResource($item->product),
            ]),
        ];
    }
}
