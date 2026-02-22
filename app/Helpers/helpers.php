<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Auth;

function currentUser(): ?User
{
    return Auth::user();
}
