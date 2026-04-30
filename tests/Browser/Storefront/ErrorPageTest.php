<?php

declare(strict_types=1);

it('renders the error page', function () {
    visit('/non-existing-page')
        ->assertNoSmoke();
});
