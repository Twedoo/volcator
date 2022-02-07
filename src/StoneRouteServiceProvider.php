<?php

namespace Twedoo\Stone;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Twedoo\Stone\Models\Parameters;

class StoneRouteServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            $PrefixTester = Request()->segment(1);
            config([
                'params' => Parameters::where('name', 'like', '%TW_APP_%')->get()->keyBy('name')->transform(function ($setting) {
                    return $setting->value;
                })->toArray()
            ]);

            if ($PrefixTester == config('prefix.urlBack')) {
                $path = realpath(base_path('resources/views/back/' . config()["params"]["TW_APP_TEMPLATE_BACK"]));
            } else {
                $path = realpath(base_path('resources/views/front/' . config()["params"]["TW_APP_TEMPLATE_FRONT"]));
            }
            view()->addLocation($path);
        }

        $singletonConfig = [
            'back' => 'resources/views/back/' . config()["params"]["TW_APP_TEMPLATE_BACK"],
            'front' => 'resources/views/front/' . config()["params"]["TW_APP_TEMPLATE_FRONT"],
            'urlBack' => config('prefix.urlBack'),
            'module' => config('prefix.module'),
        ];

        foreach ($singletonConfig as $key => $value) {
            app()->singleton($key, function () use ($value) {
                return $value;
            });
        }
        $appModules = array_diff(scandir(base_path() . '/app/Modules', 1), array('..', '.'));
        foreach ($appModules as $module) {
            if (file_exists(base_path() . '/app/Modules/' . $module . '/routes.php')) {
                include base_path() . '/app/Modules/' . $module . '/routes.php';
            }
            if (is_dir(base_path() . '/app/' . $module . '/Views')) {
                $this->loadViewsFrom(base_path() . '/app/' . $module . '/Views', $module);
            }
        }

        $stoneModules = array_diff(scandir(__DIR__.'/Modules', 1), array('..', '.'));
        foreach ($stoneModules as $module) {
            if (file_exists(__DIR__ . '/Modules/' . $module . '/routes.php')) {
                $this->loadRoutesFrom( __DIR__ . '/Modules/' . $module . '/routes.php');
            }
            if (is_dir(__DIR__ . '/Modules/' . $module . '/Views')) {
                $this->loadViewsFrom(__DIR__ . '/Modules/' . $module . '/Views', $module);
            }
        }
//        Twedoo\Stone\Http\Controllers
//        $this->app['router']->namespace('Twedoo\\Stone\\Http\\Controllers')
//            ->middleware(['web'])
//            ->group(function () {
//                $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
//            });

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->namespace('Twedoo\\Stone\\Http\\Controllers')
                ->group(__DIR__ . '/routes/web.php');
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
