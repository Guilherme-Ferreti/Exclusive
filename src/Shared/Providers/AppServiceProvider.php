<?php

declare(strict_types=1);

namespace Shared\Providers;

use Carbon\CarbonImmutable;
use Filament\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Inertia\ExceptionResponse;
use Inertia\Inertia;
use Laravel\Telescope\TelescopeServiceProvider;
use Shared\Models\User;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(TelescopeServiceProvider::class)) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureApplicationDefaults();

        $this->configureInertiaExceptionHandling();

        $this->configureResetPasswordUrl();
    }

    private function configureApplicationDefaults(): void
    {
        Vite::useAggressivePrefetching();

        URL::forceHttps(app()->isProduction());

        Date::use(CarbonImmutable::class);

        Model::automaticallyEagerLoadRelationships();

        Model::shouldBeStrict();

        DB::prohibitDestructiveCommands(app()->isProduction());

        JsonResource::withoutWrapping();

        Password::defaults(fn () => app()->isProduction()
            ? Password::min(12)->letters()->mixedCase()->numbers()->symbols()->max(255)->uncompromised()
            : null
        );
    }

    private function configureInertiaExceptionHandling(): void
    {
        Inertia::handleExceptionsUsing(function (ExceptionResponse $response) {
            if ($response->statusCode() === 500 && app()->isLocal()) {
                return;
            }

            if (in_array($response->statusCode(), [403, 404, 500, 503])) {
                return $response->render('ErrorPage', [
                    'status' => $response->statusCode(),
                ])->withSharedData();
            }
        });
    }

    private function configureResetPasswordUrl(): void
    {
        ResetPassword::createUrlUsing(fn (User $user, string $token) => route('account.auth.reset-password.create', [
            'email' => $user->email,
            'token' => $token,
        ]));
    }
}
