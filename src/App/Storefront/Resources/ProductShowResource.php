<?php

declare(strict_types=1);

namespace App\Storefront\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Shared\Models\Product;
use Shared\Resources\CategoryPreviewResource;

/**
 * @mixin Product
 */
final class ProductShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'detailImage'  => $this->detail_image,
            'currentPrice' => $this->current_price,

            'category' => new CategoryPreviewResource($this->category),
        ];
    }
}
