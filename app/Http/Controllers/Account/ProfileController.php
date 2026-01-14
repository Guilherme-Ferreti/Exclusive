<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Helpers\ToastHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Inertia\Inertia;
use Inertia\Response;

final class ProfileController extends Controller
{
    public function edit(#[CurrentUser] User $user): Response
    {
        return Inertia::render('Account/Profile/Edit', $user->only(['name', 'email', 'address']));
    }

    public function update(UpdateProfileRequest $request, #[CurrentUser] User $user)
    {
        $user->update($request->validated());

        ToastHelper::success('Changes saved successfully!');

        return back();
    }
}
