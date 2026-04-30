<?php

declare(strict_types=1);

use Illuminate\Foundation\Http\FormRequest;
use Shared\Base\Controller;

arch()->preset()->php();
arch()->preset()->security();
arch()->expect(['dd', 'dump', 'sleep'])->toBeUsedInNothing();

arch('Actions')
    ->expect('App\*\Actions')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal();

arch('Controllers')
    ->expect('App\*\Controllers')
    ->toHaveSuffix('Controller')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->toExtend(Controller::class);

arch('Requests')
    ->expect('App\*\Requests')
    ->toHaveSuffix('Request')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->toExtend(FormRequest::class)
    ->toHaveMethod('rules');
