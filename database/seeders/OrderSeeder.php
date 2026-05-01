<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Shared\Models\Order;
use Shared\Models\OrderItem;
use Shared\Models\Product;
use Shared\Models\User;

final class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::factory(10)->create();
        $products = Product::all();

        Order::factory(100)
            ->afterCreating(function (Order $order) use ($products) {
                $items = OrderItem::factory(random_int(1, 5))
                    ->for($order)
                    ->recycle($products)
                    ->create();

                $order->total = $items->sum(fn (OrderItem $item) => $item->unit_price * $item->quantity);
                $order->save();
            })
            ->recycle($users)
            ->create();
    }
}
