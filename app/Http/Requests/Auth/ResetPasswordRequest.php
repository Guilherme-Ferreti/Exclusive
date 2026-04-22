<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class ResetPasswordRequest extends FormRequest
{
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
