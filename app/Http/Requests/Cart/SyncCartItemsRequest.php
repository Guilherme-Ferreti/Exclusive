<?php

declare(strict_types=1);

namespace App\Http\Requests\Cart;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class SyncCartItemsRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items'             => ['required', 'array'],
            'items.*'           => ['required', 'array:productId,quantity'],
            'items.*.productId' => ['required', 'string', Rule::exists(Product::class, 'id')],
            'items.*.quantity'  => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }
}
