<?php

declare(strict_types=1);

namespace App\Data\Inertia;

use App\Enums\BadgeColor;
use App\Enums\OrderStatus;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript(name: 'OrderPreview')]
final class OrderPreviewData extends Data
{
    #[Computed]
    public BadgeColor $statusColor;

    #[Computed]
    public string $formattedCreatedAt;

    public function __construct(
        public string $id,
        public string $number,
        public Carbon $createdAt,
        public int $total,
        public OrderStatus $status,
    ) {
        $this->statusColor = $status->color();

        $this->formattedCreatedAt = $createdAt->format('M d, Y');
    }
}
