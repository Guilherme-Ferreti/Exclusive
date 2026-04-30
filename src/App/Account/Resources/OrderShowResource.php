<?php

declare(strict_types=1);

namespace App\Account\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Shared\Models\Order;
use Shared\Models\OrderItem;

/**
 * @mixin Order
 */
final class OrderShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'number'      => $this->number,
            'orderedAt'   => $this->created_at->format('M d, Y h:i A'),
            'total'       => $this->total,
            'status'      => $this->status->value,
            'statusColor' => $this->status->color()->value,

            'items' => $this->items->map(fn (OrderItem $item) => [
                'id'        => $item->id,
                'quantity'  => $item->quantity,
                'unitPrice' => $item->unit_price,
                'subtotal'  => $item->unit_price * $item->quantity,

                'product' => [
                    'id'   => $item->product->id,
                    'name' => $item->product->name,
                ],
            ]),
        ];
    }
}
