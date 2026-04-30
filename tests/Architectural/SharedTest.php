<?php

declare(strict_types=1);

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

arch('Base')
    ->expect('Shared\Base')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeAbstract();

arch('Enums')
    ->expect('Shared\Enums')
    ->toBeEnums();

arch('Helpers')
    ->expect('Shared\Helpers')
    ->toHaveSuffix('Helper')
    ->toUseStrictTypes()
    ->toBeFinal()
    ->toExtendNothing()
    ->toImplementNothing()
    ->not->toHaveProtectedMethods()
    ->not->toHavePrivateMethods();

arch('Middleware')
    ->expect('Shared\Middleware')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal();

arch('Models')
    ->expect('Shared\Models')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->not->toHavePrivateMethods()
    ->toExtend(Model::class);

arch('Providers')
    ->expect('Shared\Providers')
    ->toHaveSuffix('Provider')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->toExtend(ServiceProvider::class)
    ->toImplementNothing();

arch('Rules')
    ->expect('Shared\Rules')
    ->toUseStrictTypes()
    ->toBeClasses()
    ->toBeFinal()
    ->toExtendNothing()
    ->toImplement(ValidationRule::class);
