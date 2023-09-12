<?php

declare(strict_types=1);

namespace MiiKabachok\LaravelLocalization\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as Provider;
use MiiKabachok\LaravelLocalization\Middleware\SetLocaleFromUrl;

class ServiceProvider extends Provider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $kernel = $this->app->make(Kernel::class);

        $kernel->appendMiddlewareToGroup('web', SetLocaleFromUrl::class);
        $kernel->prependToMiddlewarePriority(SetLocaleFromUrl::class);

        $this->publishes([
            __DIR__.'/../config/locales.php' => App::configPath('locales.php'),
        ]);
    }
}
