<?php

declare(strict_types=1);

namespace Shared\Providers;

use Spatie\LaravelTypeScriptTransformer\RouteFilters\NamedRouteFilter;
use Spatie\LaravelTypeScriptTransformer\TransformedProviders\LaravelRouteTransformedProvider;
use Spatie\LaravelTypeScriptTransformer\TypeScriptTransformerApplicationServiceProvider as BaseTypeScriptTransformerServiceProvider;
use Spatie\TypeScriptTransformer\TypeScriptTransformerConfigFactory;

final class TypeScriptTransformerServiceProvider extends BaseTypeScriptTransformerServiceProvider
{
    protected function configure(TypeScriptTransformerConfigFactory $config): void
    {
        $config
            ->outputDirectory(resource_path('js/types'))
            ->provider(new LaravelRouteTransformedProvider(
                filters: [
                    new NamedRouteFilter('debugbar.*', 'filament.*', 'livewire.*', 'telescope.*', 'telescope', 'boost.*', 'default-livewire.*'),
                ]
            ));
    }
}
