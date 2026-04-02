<?php

declare(strict_types=1);

namespace App\Data\Actions\Admin;

use Spatie\LaravelData\Data;

final class UpdateProductData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description,
        public int $current_price,
        public string $preview_image,
        public string $detail_image,
        public string $category_id,
    ) {}
}
