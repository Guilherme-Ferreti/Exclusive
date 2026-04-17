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

        $itemsToAdd    = $items->filter(fn (array $item) => ! $cartItems->contains('product_id', $item['productId']));
        $itemsToDelete = $cartItems->filter(fn (CartItem $cartItem) => ! $items->contains('productId', $cartItem->product_id));
        $itemsToUpdate = $cartItems->filter(fn (CartItem $cartItem) => $items->contains('productId', $cartItem->product_id));

        $itemsToAdd->each(fn (array $item) => app(AddItemToCart::class)->handle(
            cart: $cart,
            productId: $item['productId'],
            quantity: $item['quantity'],
        ));

        $itemsToUpdate->each(fn (CartItem $cartItem) => app(AddItemToCart::class)->handle(
            cart: $cart,
            productId: $cartItem->product_id,
            quantity: $items->firstWhere('productId', $cartItem->product_id)['quantity'],
        ));

        $itemsToDelete->each(fn (CartItem $cartItem) => $cartItem->delete());

        cache()->forget(CacheKey::cartItems($cart->user->id));
    }
}
