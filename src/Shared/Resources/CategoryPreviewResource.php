<?php

declare(strict_types=1);

namespace Shared\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Shared\Models\Category;

/**
 * @mixin Category
 */
final class CategoryPreviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
