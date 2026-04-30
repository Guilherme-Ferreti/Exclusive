<?php

declare(strict_types=1);

namespace App\Account\Controllers;

use App\Account\Actions\SendPasswordResetLink;
use App\Account\Requests\ForgotPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Inertia\Response;
use Shared\Base\Controller;
use Shared\Helpers\ToastHelper;

final class ForgotPasswordController extends Controller
{
    public function create(): Response
    {
        return inertia('Account/Auth/ForgotPassword');
    }

    public function store(ForgotPasswordRequest $request): RedirectResponse
    {
        $status = app(SendPasswordResetLink::class)->handle($request->input('email'));

        if ($status !== Password::RESET_LINK_SENT) {
            return back()
                ->withInput(request()->only('email'))
                ->withErrors(['email' => __($status)]);
        }

        ToastHelper::success('We have emailed your password reset link!');

        return back();
    }
}
