<?php

declare(strict_types=1);

namespace App\Account\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class ResetPasswordRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token'                => ['required', 'string'],
            'email'                => ['required', 'string', 'email'],
            'password'             => ['required', 'string', Password::default()],
            'passwordConfirmation' => ['required', 'string', 'same:password'],
        ];
    }
}
