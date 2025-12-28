<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

final class EditProfileController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Account/Profile/Edit');
    }
}
