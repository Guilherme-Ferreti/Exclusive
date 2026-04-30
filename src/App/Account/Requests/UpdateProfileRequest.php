<?php

declare(strict_types=1);

namespace App\Account\Requests;

use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shared\Models\User;

final class UpdateProfileRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(#[CurrentUser] User $user): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'max:255', 'email', Rule::unique('users', 'email')->ignore($user)],
            'address' => ['present', 'nullable', 'string', 'max:255'],
        ];
    }
}
