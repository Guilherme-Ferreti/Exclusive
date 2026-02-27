<?php

declare(strict_types=1);

namespace App\Data\Actions;

use Spatie\LaravelData\Data;

final class StoreProductData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description,
        public ?string $preview_image,
        public ?string $detail_image,
        public int $current_price,
        public string $category_id,
    ) {}
}
