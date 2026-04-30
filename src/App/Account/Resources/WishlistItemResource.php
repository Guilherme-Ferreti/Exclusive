<?php

declare(strict_types=1);

namespace App\Account\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Shared\Models\Product;

/**
 * @mixin Product
 */
final class WishlistItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'previewImage' => $this->preview_image,
            'detailImage'  => $this->detail_image,
            'currentPrice' => $this->current_price,
        ];
    }
}
