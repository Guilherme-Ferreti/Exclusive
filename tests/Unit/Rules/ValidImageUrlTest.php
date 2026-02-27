<?php

declare(strict_types=1);

use App\Rules\ValidImageUrl;
use Illuminate\Support\Facades\Http;

it('validates correct image URLs', function () {
    Http::fake([
        '*' => Http::response('', 200, ['Content-Type' => 'image/png']),
    ]);

    $validUrls = [
        'https://placehold.co/534x735?text=Test',
        'https://laravel.com/images/learn/navigation/Nav-Laracast.png',
    ];

    foreach ($validUrls as $url) {
        $failed = false;

        (new ValidImageUrl)->validate('test', $url, function () use (&$failed) {
            $failed = true;
        });

        expect($failed)->toBeFalse();
    }
});

it('rejects invalid URLs', function () {
    Http::fake([
        '*' => Http::response('', 200, ['Content-Type' => 'text/html']),
    ]);

    $invalidUrls = [
        'not-a-url',
        'ftp://example.com/file.jpg',
        'https://google.com/search?q=image.jpg',
        'javascript:alert("xss")',
        '',
        null,
        [],
        123,
    ];

    foreach ($invalidUrls as $url) {
        $failed = false;

        (new ValidImageUrl)->validate('test', $url, function () use (&$failed) {
            $failed = true;
        });

        expect($failed)->toBeTrue();
    }
});
