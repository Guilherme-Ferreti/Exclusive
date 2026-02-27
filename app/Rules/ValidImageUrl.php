<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

final class ValidImageUrl implements ValidationRule
{
    /**
     * @param  Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $fail('The :attribute must be a string.');

            return;
        }

        if (! $this->isValidUrlScheme($value)) {
            $fail('The :attribute must be a valid HTTP or HTTPS URL.');

            return;
        }

        if (! $this->isValidPath($value)) {
            $fail('The :attribute must have a valid path.');

            return;
        }

        if (! $this->hasValidImageHttpResponse($value)) {
            $fail('The :attribute must respond with a valid image.');
        }
    }

    private function isValidUrlScheme(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_URL) && in_array(parse_url($value, PHP_URL_SCHEME), ['http', 'https'], true);
    }

    private function isValidPath(string $value): bool
    {
        return (bool) parse_url($value, PHP_URL_PATH);
    }

    private function hasValidImageHttpResponse(string $value): bool
    {
        $response = Http::get($value);

        return $response->ok() && str_contains($response->header('Content-Type'), 'image/');
    }
}
