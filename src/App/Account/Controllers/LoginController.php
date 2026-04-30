<?php

declare(strict_types=1);

namespace App\Account\Controllers;

use App\Account\Actions\Login;
use App\Account\Actions\Logout;
use App\Account\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Shared\Base\Controller;

final class LoginController extends Controller
{
    public function create(): Response
    {
        return inertia('Account/Auth/Login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $authenticated = app(Login::class)->handle($request->email, $request->password);

        if (! $authenticated) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        return redirect()->intended(route('storefront.home'));
    }

    public function destroy(): RedirectResponse
    {
        app(Logout::class)->handle();

        return redirect()->route('storefront.home');
    }
}
