<?php

namespace Twedoo\Volcator;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Twedoo\Volcator\Models\Parameters;

class VolcatorRouteServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            $segment_one = Request()->segment(1);
            $segment_two = Request()->segment(2);
            $segment_three = Request()->segment(3);

            config([
                'params' => Parameters::where('name', 'like', '%TW_APP_%')->get()->keyBy('name')->transform(function ($setting) {
                    return $setting->value;
                })->toArray()
            ]);

             if ($segment_one == config()["params"]["TW_APP_BACK_PREFIX"] || 'invite/'.config()["params"]["TW_APP_BACK_PREFIX"] == $segment_one.'/'.$segment_two) {
                $path =   '../resources/views/back/' . config()["params"]["TW_APP_TEMPLATE_BACK"];
            } else {
                $path =   'resources/views/front/' . config()["params"]["TW_APP_TEMPLATE_FRONT"];
            }
            view()->addLocation($path);

            $singletonConfig = [
                'APP_NAME' => config()["params"]["TW_APP_NAME"],
                'back' => $path,
                'front' => $path,
                'urlBack' => config()["params"]["TW_APP_BACK_PREFIX"],
                'urlFront' => config()["params"]["TW_APP_FRONT_PREFIX"],
                'module' => config()["params"]["TW_APP_MODULE"],
            ];

            foreach ($singletonConfig as $key => $value) {
                app()->singleton($key, function () use ($value) {
                    return $value;
                });
            }
            $appModules = array_diff(scandir(app_path() . '/Modules', 1), array('..', '.'));
            foreach ($appModules as $module) {

                if (file_exists(app_path() . '/Modules/' . $module . '/Routes/routes.php')) {
                    Route::middleware('web')->group(app_path() . '/Modules/' . $module . '/Routes/routes.php');
                    $this->loadRoutesFrom(app_path() . '/Modules/' . $module . '/Routes/routes.php');
                }
                if (file_exists(app_path() . '/Modules/' . $module . '/Routes/channels.php')) {
                    Route::middleware('web')->group(app_path() . '/Modules/' . $module . '/Routes/channels.php');
                    $this->loadRoutesFrom(app_path() . '/Modules/' . $module . '/Routes/channels.php');
                }
                if (is_dir(app_path() . '/Modules/' . $module . '/Views')) {
                    $this->loadViewsFrom(app_path() . '/Modules/' . $module . '/Views', $module);
                }
            }

            $volcatorModules = array_diff(scandir(__DIR__ . '/Modules', 1), array('..', '.'));

            foreach ($volcatorModules as $module) {
                if (file_exists(__DIR__ . '/Modules/' . $module . '/Routes/routes.php')) {
                    Route::middleware('web')->group(__DIR__ . '/Modules/' . $module . '/Routes/routes.php');
                    $this->loadRoutesFrom(__DIR__ . '/Modules/' . $module . '/Routes/routes.php');
                }
                if (file_exists(__DIR__ . '/Modules/' . $module . '/Routes/channels.php')) {
                    Route::middleware('web')->group(__DIR__ . '/Modules/' . $module . '/Routes/channels.php');
                    $this->loadRoutesFrom(__DIR__ . '/Modules/' . $module . '/Routes/channels.php');
                }

                if (is_dir(__DIR__ . '/Modules/' . $module . '/Views')) {
                    $this->loadViewsFrom(__DIR__ . '/Modules/' . $module . '/Views', $module);
                }
            }
            Route::getRoutes()->refreshNameLookups();
            Route::getRoutes()->refreshActionLookups();
            $this->configureRateLimiting();

            $this->routes(function () {
                Route::middleware('web')
                    ->namespace('Twedoo\\Volcator\\Http\\Controllers')
                    ->group(__DIR__ . '/routes/web.php');
            });
        }
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
