<?php

declare(strict_types=1);

namespace App\Account\Controllers;

use App\Account\Actions\Login;
use App\Account\Actions\SignUp\SignUp;
use App\Account\Actions\SignUp\SignUpData;
use App\Account\Requests\SignUpRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Shared\Base\Controller;

final class SignUpController extends Controller
{
    public function create(): Response
    {
        return inertia('Account/Auth/SignUp');
    }

    public function store(SignUpRequest $request): RedirectResponse
    {
        app(SignUp::class)->handle(SignUpData::fromRequest($request));

        app(Login::class)->handle($request->email, $request->password);

        return redirect()->route('storefront.home');
    }
}
