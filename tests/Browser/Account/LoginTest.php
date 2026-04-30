<?php

declare(strict_types=1);

it('renders the login page', function () {
    visit(route('account.auth.login.create'))
        ->assertNoSmoke();
});
