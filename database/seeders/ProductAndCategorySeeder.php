<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use TCGdex\Model\CardResume;
use TCGdex\Model\Set;
use TCGdex\Model\SetResume;
use TCGdex\TCGdex;

final class ProductAndCategorySeeder extends Seeder
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
        $prices     = [];

        foreach ($this->getSets() as $set) {
            $categories[] = [
                'id'         => (new Category)->newUniqueId(),
                'name'       => $set->name,
                'slug'       => Str::slug($set->name),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            foreach ($set->cards as $card) {
                $products[] = [
                    'id'            => (new Product)->newUniqueId(),
                    'name'          => $this->generateProductName($card, $set),
                    'preview_image' => $card->image ? $card->image . '/low.webp' : null,
                    'detail_image'  => $card->image ? $card->image . '/high.webp' : null,
                    'current_price' => Arr::random([50, 75, 100, 125, 150, 175, 200, 255, 250, 275, 300, 350, 400, 450, 500]),
                    'category_id'   => array_last($categories)['id'],
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];

                $prices[] = [
                    'id'         => (new Price)->newUniqueId(),
                    'price'      => array_last($products)['current_price'],
                    'started_at' => now(),
                    'ended_at'   => null,
                    'product_id' => array_last($products)['id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Category::insert($categories);

        collect($products)
            ->chunk(1000)
            ->each(fn (Collection $chunk) => Product::insert($chunk->toArray()));

        collect($prices)
            ->chunk(1000)
            ->each(fn (Collection $chunk) => Price::insert($chunk->toArray()));

        $this->markRandomCategoriesAsFeatured();
    }

    /**
     * @return Collection<Set>
     */
    private function getSets(): Collection
    {
        $seriesCodes = ['me', 'sv'];

        return collect($seriesCodes)
            ->flatMap(fn (string $code) => $this->sdk->serie->get($code)->sets)
            ->map(fn (SetResume $set) => $this->sdk->set->get($set->id));
    }

    private function generateProductName(CardResume $card, Set $set): string
    {
        $setTotalCardCount = Str::padLeft((string) $set->cardCount->total, 3, '0');

        return "{$card->name} (#{$card->localId}/{$setTotalCardCount})";
    }

    private function markRandomCategoriesAsFeatured(): void
    {
        $ids = Category::inRandomOrder()->take(6)->pluck('id')->toArray();

        Category::whereIn('id', $ids)->update(['is_featured' => true]);
    }
}
