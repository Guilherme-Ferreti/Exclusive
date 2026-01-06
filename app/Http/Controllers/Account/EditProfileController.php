<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

final class EditProfileController extends Controller
{
    public function edit(#[CurrentUser] User $user): Response
    {
        return Inertia::render('Account/Profile/Edit', $user->only(['name', 'email', 'address']));
    }

    public function update(Request $request, #[CurrentUser] User $user)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'max:255', 'email', Rule::unique('users', 'email')->ignore($user)],
            'address' => ['present', 'nullable', 'string', 'max:255'],
        ]);

        $user->update($data);

        return back();
    }
}
