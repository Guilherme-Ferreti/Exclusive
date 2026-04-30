<?php

declare(strict_types=1);

namespace App\Account\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Shared\Models\Order;

/**
 * @mixin Order
 */
final class OrderIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'number'       => $this->number,
            'orderedAtDay' => $this->created_at->format('M d, Y'),
            'total'        => $this->total,
            'status'       => $this->status->value,
            'statusColor'  => $this->status->color()->value,
        ];
    }
}
