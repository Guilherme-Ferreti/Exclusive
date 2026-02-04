<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class ValidImageUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
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

        if (! $this->hasValidImageFileExtension($value)) {
            $fail('The :attribute must be a valid image URL (jpg, jpeg, png, gif, webp, svg, bmp, ico).');
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

    private function hasValidImageFileExtension(string $value): bool
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'ico'];

        $path = parse_url($value, PHP_URL_PATH);

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return in_array($extension, $allowedExtensions, true);
    }
}
