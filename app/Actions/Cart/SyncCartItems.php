<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Enums\CacheKey;
use App\Models\Cart;
use App\Models\CartItem;

final class SyncCartItems
{
    /**
     * @param  array<int, array{productId: string, quantity: int}>  $items
     */
    public function handle(Cart $cart, array $items): void
    {
        $items     = collect($items);
        $cartItems = $cart->items()->get();

        $itemsToInsert = $items->filter(fn (array $item) => ! $cartItems->contains('product_id', $item['productId']));
        $itemsToDelete = $cartItems->filter(fn (CartItem $cartItem) => ! $items->contains('productId', $cartItem->product_id));
        $itemsToUpdate = $cartItems->filter(fn (CartItem $cartItem) => $items->contains('productId', $cartItem->product_id));

        $itemsToInsert->each(fn (array $item) => $cart->items()->create([
            'product_id' => $item['productId'],
            'quantity'   => $item['quantity'],
        ]));

        $itemsToDelete->each(fn (CartItem $cartItem) => $cartItem->delete());

        $itemsToUpdate->each(fn (CartItem $cartItem, int $index) => $cartItem->update([
            'quantity' => $items->firstWhere('productId', $cartItem->product_id)['quantity'],
        ]));

        cache()->forget(CacheKey::cartItems($cart->user->id));
    }
}
