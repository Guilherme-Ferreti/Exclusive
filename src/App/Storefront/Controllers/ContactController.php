<?php

declare(strict_types=1);

namespace App\Storefront\Controllers;

use Inertia\Response;
use Shared\Base\Controller;

final class ContactController extends Controller
{
    public function __invoke(): Response
    {
        return inertia('Storefront/Contact');
    }
}
