<?php

declare(strict_types=1);

namespace App\Account\Controllers;

use App\Account\Actions\UpdateProfile\UpdateProfile;
use App\Account\Actions\UpdateProfile\UpdateProfileData;
use App\Account\Requests\UpdateProfileRequest;
use App\Account\Resources\ProfileEditResource;
use Illuminate\Container\Attributes\CurrentUser;
use Inertia\Response;
use Shared\Base\Controller;
use Shared\Helpers\ToastHelper;
use Shared\Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class ProfileController extends Controller
{
    public function edit(#[CurrentUser] User $user): Response
    {
        return inertia('Account/Profile/Edit', [
            'profile' => new ProfileEditResource($user),
        ]);
    }

    public function update(UpdateProfileRequest $request, #[CurrentUser] User $user): RedirectResponse
    {
        app(UpdateProfile::class)->handle($user, UpdateProfileData::fromRequest($request));

        ToastHelper::success('Changes saved successfully!');

        return back();
    }
}
