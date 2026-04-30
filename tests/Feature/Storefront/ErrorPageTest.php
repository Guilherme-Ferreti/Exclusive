<?php

declare(strict_types=1);

use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('loads the error page with status 404', function () {
    get('/non-existing-page')
        ->assertNotFound()
        ->assertInertia(fn (Assert $page) => $page->component('ErrorPage')->where('status', 404));
});
