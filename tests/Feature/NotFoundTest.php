<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('successfully renders the not found page', function () {
    get('/non-existing-page')
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page->component('NotFound'));
});
