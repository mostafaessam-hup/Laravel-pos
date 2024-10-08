<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        parent::boot();
    }

    public function map()
    {

        $this->mapWebRoutes();
        $this->mapAdminWebRoutes();
        $this->mapAdminWebAuthRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    // protected function mapApiRoutes()
    // {
    //     Route::prefix('api')
    //         ->middleware('api')
    //         ->namespace($this->namespace)
    //         ->group(base_path('routes/api.php'));
    // }

    protected function mapAdminWebRoutes()
    {
        Route::middleware(['web', 'auth:admin', 'localizationRedirect', 'localeViewPath'])
            ->prefix(LaravelLocalization::setLocale() . '/admin')
            ->name('admin.')
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin/web/web.php'));
    }

    protected function mapAdminWebAuthRoutes()
    {
        Route::middleware(['web', 'guest:admin', 'localizationRedirect', 'localeViewPath'])
            ->prefix(LaravelLocalization::setLocale() . '/admin')
            ->name('admin.')
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin/web/auth.php'));
    }
}
