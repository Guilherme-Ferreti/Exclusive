<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;

final class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $categories = Category::take(6)->get(['name', 'slug'])->toArray();

        return Inertia::render('Home', compact('categories'));
    }
}
