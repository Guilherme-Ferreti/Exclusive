<?php

declare(strict_types=1);

namespace App\Data\Inertia;

use App\Enums\BadgeColor;
use App\Enums\OrderStatus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript(name: 'OrderShowData')]
#[MapInputName(SnakeCaseMapper::class)]
final class OrderShowData extends Data
{
    #[Computed]
    public BadgeColor $statusColor;

    #[Computed]
    public string $orderedAt;

    public function __construct(
        public string $id,
        public string $number,
        public Carbon $createdAt,
        public int $total,
        public OrderStatus $status,

        /** @var Collection<OrderItemShowData> */
        public Collection $items,
    ) {
        $this->statusColor = $status->color();

        $this->orderedAt = $createdAt->format('M d, Y h:i A');
    }
}
