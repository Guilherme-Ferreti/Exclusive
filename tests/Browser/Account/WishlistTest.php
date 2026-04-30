<?php

declare(strict_types=1);

use Shared\Models\User;

use function Pest\Laravel\actingAs;

it('renders the wishlist page', function () {
    $user = User::factory()->create();

    actingAs($user);

    visit(route('account.wishlist'))
        ->assertNoSmoke();
});
