<?php

declare(strict_types=1);

namespace App\Account\Controllers;

use App\Account\Actions\ResetPassword\ResetPassword;
use App\Account\Actions\ResetPassword\ResetPasswordData;
use App\Account\Requests\ResetPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Response;
use Shared\Base\Controller;
use Shared\Helpers\ToastHelper;

final class ResetPasswordController extends Controller
{
    public function create(Request $request): Response
    {
        return inertia('Account/Auth/ResetPassword', $request->only('token', 'email'));
    }

    public function store(ResetPasswordRequest $request): RedirectResponse
    {
        $status = app(ResetPassword::class)->handle(ResetPasswordData::fromRequest($request));

        if ($status !== Password::PASSWORD_RESET) {
            ToastHelper::error(__($status));

            return back();
        }

        ToastHelper::success('Your password has been reset!');

        return redirect()->route('account.auth.login.create');
    }
}
