<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Enums\OrderStatus;
use App\Helpers\OrderHelper;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

final class CheckoutCart
{
    public function handle(Cart $cart): Order
    {
        return DB::transaction(function () use ($cart) {
            $total = $cart->items->sum(fn (CartItem $item) => $item->product->current_price * $item->quantity);

            $order = Order::create([
                'user_id' => $cart->user_id,
                'total'   => $total,
                'status'  => OrderStatus::PENDING,
                'number'  => OrderHelper::generateNumber(),
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'unit_price' => $item->product->current_price,
                ]);
            }

            app(EmptyCart::class)->handle($cart);

            return $order;
        });
    }
}
