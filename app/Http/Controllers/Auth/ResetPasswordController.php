<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Helpers\ToastHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Response;

final class ResetPasswordController extends Controller
{
    public function create(Request $request): Response
    {
        return inertia('Auth/ResetPassword', $request->only('token', 'email'));
    }

    public function store(ResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::reset(
            credentials: [
                'token'                 => $request->input('token'),
                'email'                 => $request->input('email'),
                'password'              => $request->input('password'),
                'password_confirmation' => $request->input('passwordConfirmation'),
            ],
            callback: function (User $user, $password) {
                $user->forceFill([
                    'password' => $password,
                ])->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            ToastHelper::error(__($status));

            return back();
        }

        ToastHelper::success('Your password has been reset!');

        return redirect()->route('auth.login.create');
    }
}
