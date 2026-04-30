<?php

declare(strict_types=1);

it('renders the sign up page', function () {
    visit(route('account.auth.sign-up.create'))
        ->assertNoSmoke();
});
