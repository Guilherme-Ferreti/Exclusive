<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Helpers\ToastHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Inertia\Response;

final class ForgotPasswordController extends Controller
{
    public function create(): Response
    {
        return inertia('Auth/ForgotPassword');
    }

    public function store(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink($request->only('email'));

        if ($status !== Password::RESET_LINK_SENT) {
            return back()
                ->withInput(request()->only('email'))
                ->withErrors(['email' => __($status)]);
        }

        ToastHelper::success('We have emailed your password reset link!');

        return back();
    }
}
