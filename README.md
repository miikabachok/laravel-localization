### 1. Installation via [Composer](https://getcomposer.org/).
```
composer require miikabachok/laravel-localization
```

### 2. You need to publish package [configuration file](https://github.com/miikabachok/laravel-localization/blob/master/src/config/locales.php) to the application's config directory.
```
php artisan vendor:publish --provider="MiiKabachok\LaravelLocalization\Providers\ServiceProvider"
```

### 3. Defining routes in routes/web.php file.
```
<?php

declare(strict_types=1);

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use MiiKabachok\LaravelLocalization\Middleware\SetLocaleFromUrl;

/**
 * Redirect a non-localized route (or with invalid locale value) request to localized one.
 */
Route::get('/{invalidLocale?}', function (): RedirectResponse {
    return Redirect::route('/', ['locale' => App::getLocale()]);
})->withoutMiddleware(SetLocaleFromUrl::class)->where(['invalidLocale' => '^[^//]{3,}.*$']);

/**
 * Group of all localized application routes.
 */
Route::prefix('{locale}')->where(['locale' => '[A-Za-z]{2}'])->group(function (): void {
    /**
     * Declare all your routes here.
     */
    Route::get('/', function (): \Illuminate\Contracts\View\View {
        return View::make('welcome');
    })->name('/');
});
```
