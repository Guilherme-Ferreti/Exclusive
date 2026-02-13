<?php

declare(strict_types=1);

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\ServiceProvider;

arch()->preset()->php();
arch()->preset()->security();
arch()->expect(['dd', 'dump'])->toBeUsedInNothing();

arch('Enums')
    ->expect('App\Enums')
    ->toBeEnums();

arch('Helpers')
    ->expect('App\Helpers')
    ->classes()
    ->toHaveSuffix('Helper')
    ->toUseStrictTypes()
    ->toBeFinal()
    ->toExtendNothing()
    ->toImplementNothing()
    ->not->toHaveProtectedMethods()
    ->not->toHavePrivateMethods();

arch('Middleware')
    ->expect('App\Http\Middleware')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal();

arch('Models')
    ->expect('App\Models')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->toExtend(Model::class);

arch('Providers')
    ->expect('App\Providers')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->toExtend(ServiceProvider::class)
    ->toImplementNothing();

arch('Requests')
    ->expect('App\Http\Requests')
    ->toUseStrictTypes()
    ->toHaveSuffix('Request')
    ->toBeClasses()
    ->toBeFinal()
    ->toExtend(FormRequest::class)
    ->toHaveMethod('rules');

arch('Resources')
    ->expect('App\Http\Resources')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->toHaveMethod('toArray');

arch('Rules')
    ->expect('App\Rules')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->toExtendNothing()
    ->toImplement(ValidationRule::class);
