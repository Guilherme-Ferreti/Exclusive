<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(ProductsSeeder::class);

        $this->markRandomCategoriesAsFeatured();
    }

    private function markRandomCategoriesAsFeatured(): void
    {
        $ids = Category::inRandomOrder()->take(6)->pluck('id')->toArray();

        Category::whereIn('id', $ids)->update(['is_featured' => true]);
    }
}
