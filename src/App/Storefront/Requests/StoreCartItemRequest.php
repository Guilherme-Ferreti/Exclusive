<?php

declare(strict_types=1);

namespace App\Storefront\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shared\Models\Product;

final class StoreCartItemRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'productId' => ['required', 'string', Rule::exists(Product::class, 'id')],
            'quantity'  => ['required', 'numeric', 'min:1', 'max:100'],
        ];
    }
}
