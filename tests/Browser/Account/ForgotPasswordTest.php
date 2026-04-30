<?php

declare(strict_types=1);

it('renders the forgot password page', function () {
    visit(route('account.auth.forgot-password.create'))
        ->assertNoSmoke();
});
