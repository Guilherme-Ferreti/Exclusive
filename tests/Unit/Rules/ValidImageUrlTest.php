<?php

declare(strict_types=1);

use App\Rules\ValidImageUrl;

it('validates correct image URLs', function () {
    $rule = new ValidImageUrl;

    $validUrls = [
        'https://example.com/image.jpg',
        'https://example.com/image.png',
        'https://example.com/image.gif',
        'https://example.com/image.webp',
        'https://example.com/image.svg',
        'https://example.com/image.bmp',
        'https://example.com/image.ico',
        'https://example.com/path/to/image.jpeg',
        'https://subdomain.example.com/image.jpg',
        'https://example.com/image.jpg?query=param&other=value',
    ];

    foreach ($validUrls as $url) {
        $failed = false;

        $rule->validate('test', $url, function () use (&$failed) {
            $failed = true;
        });

        expect($failed)->toBeFalse();
    }
});

it('rejects invalid URLs', function () {
    $rule = new ValidImageUrl;

    $invalidUrls = [
        'not-a-url',
        'ftp://example.com/file.jpg',
        'javascript:alert("xss")',
        '',
        null,
        [],
        123,
    ];

    foreach ($invalidUrls as $url) {
        $failed = false;

        $rule->validate('test', $url, function () use (&$failed) {
            $failed = true;
        });

        expect($failed)->toBeTrue();
    }
});

it('rejects URLs without image extensions', function () {
    $rule = new ValidImageUrl;

    $nonImageUrls = [
        'https://example.com/file.pdf',
        'https://example.com/document.doc',
        'https://example.com/page.html',
        'https://example.com/video.mp4',
        'https://example.com/audio.mp3',
        'https://example.com/file.txt',
        'https://example.com/',
        'https://example.com/path/no-extension',
    ];

    foreach ($nonImageUrls as $url) {
        $failed = false;

        $rule->validate('test', $url, function () use (&$failed) {
            $failed = true;
        });

        expect($failed)->toBeTrue();
    }
});

it('rejects URLs without path', function () {
    $rule = new ValidImageUrl;

    $urlsWithoutPath = [
        'https://example.com',
        'https://example.com/',
        'https://example.com?query=param',
    ];

    foreach ($urlsWithoutPath as $url) {
        $failed = false;

        $rule->validate('test', $url, function () use (&$failed) {
            $failed = true;
        });

        expect($failed)->toBeTrue();
    }
});
