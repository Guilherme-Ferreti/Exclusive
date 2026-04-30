<?php

declare(strict_types=1);

namespace App\Admin\Actions\UpdateProduct;

final class UpdateProductData
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
