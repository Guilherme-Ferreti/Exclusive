<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use TCGdex\Model\CardResume;
use TCGdex\Model\Set;
use TCGdex\Model\SetResume;
use TCGdex\TCGdex;

final class ProductsSeeder extends Seeder
{
    private TCGdex $sdk;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->sdk = new TCGdex('en');

        $categories = [];
        $products   = [];

        foreach ($this->getSets() as $set) {
            $categories[] = [
                'id'         => (new Category)->newUniqueId(),
                'name'       => $set->name,
                'slug'       => Str::slug($set->name),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $products[] = Arr::map($set->cards, fn (CardResume $card) => [
                'id'            => (new Product)->newUniqueId(),
                'name'          => $this->generateProductName($card, $set),
                'preview_image' => $card->image ? $card->image . '/low.webp' : null,
                'detail_image'  => $card->image ? $card->image . '/high.webp' : null,
                'category_id'   => array_last($categories)['id'],
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

        Category::insert($categories);

        collect($products)
            ->flatten(1)
            ->chunk(1000)
            ->each(fn (Collection $chunk) => Product::insert($chunk->toArray()));
    }

    /**
     * @return Collection<Set>
     */
    private function getSets(): Collection
    {
        $seriesCodes = app()->isProduction()
            ? ['me']
            : ['me', 'sv', 'swsh'];

        return collect($seriesCodes)
            ->flatMap(fn (string $code) => $this->sdk->serie->get($code)->sets)
            ->map(fn (SetResume $set) => $this->sdk->set->get($set->id));
    }

    private function generateProductName(CardResume $card, Set $set): string
    {
        $setTotalCardCount = Str::padLeft((string) $set->cardCount->total, 3, '0');

        return "{$card->name} (#{$card->localId}/{$setTotalCardCount})";
    }
}
