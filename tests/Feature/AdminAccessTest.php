<?php

declare(strict_types=1);

use App\Models\User;

use function Pest\Laravel\actingAs;

it('allows admin users to access the admin panel', function () {
    $admin = User::factory()->admin()->create();

    actingAs($admin)
        ->get(route('filament.admin.pages.dashboard'))
        ->assertOk();
});

it('blocks non-admin users from accessing the admin panel', function () {
    $user = User::factory()->create(['is_admin' => false]);

    actingAs($user)
        ->get(route('filament.admin.pages.dashboard'))
        ->assertForbidden();
});
