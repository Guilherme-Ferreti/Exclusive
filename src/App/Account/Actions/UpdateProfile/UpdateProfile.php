<?php

declare(strict_types=1);

namespace App\Account\Actions\UpdateProfile;

use Shared\Models\User;

final class UpdateProfile
{
    public function handle(User $user, UpdateProfileData $data): void
    {
        $user->update((array) $data);
    }
}
