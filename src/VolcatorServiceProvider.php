<?php

namespace Twedoo\Volcator;

use App\Events\NotificationBroadcast;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Core\VolcatorInvitation;
use Twedoo\Volcator\Core\VolcatorLanguage;
use Twedoo\Volcator\Core\VolcatorMenu;
use Twedoo\Volcator\Core\VolcatorEmailNotification;
use Twedoo\Volcator\Core\VolcatorPushNotification;
use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Core\VolcatorStructure;
use Twedoo\Volcator\Core\VolcatorTranslation;
use Twedoo\Volcator\Core\Utils\VolcatorFile;
use Twedoo\Volcator\Core\Utils\VolcatorPath;
use Twedoo\Volcator\Facades\VolcatorEngineFacade;
use Twedoo\Volcator\Facades\VolcatorFileFacade;
use Twedoo\Volcator\Facades\VolcatorLanguageFacade;
use Twedoo\Volcator\Facades\VolcatorMediaStyleFacade;
use Twedoo\Volcator\Facades\VolcatorMenuFacade;
use Twedoo\Volcator\Facades\VolcatorPathFacade;
use Twedoo\Volcator\Facades\VolcatorTranslationFacade;
use Twedoo\Volcator\Http\Middleware\CheckModules;
use Twedoo\Volcator\Http\Middleware\Language;
use Twedoo\Volcator\Models\Parameters;
use Twedoo\Volcator\Core\Utils\VolcatorMediaStyle;
use Twedoo\VolcatorGuard\VolcatorGuardServiceProvider;
use Twedoo\Volcator\MigrationCommand;
use Twedoo\Volcator\SeederCommand;
use Config;

class VolcatorServiceProvider extends ServiceProvider
{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Will make sure that the required modules have been fully loaded
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot() {
        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', Language::class);
        $router->pushMiddlewareToGroup('web', CheckModules::class);
        $router->pushMiddlewareToGroup('web', \Twedoo\VolcatorGuard\Middleware\UserEnable::class);
        $router->aliasMiddleware('role', \Twedoo\VolcatorGuard\Middleware\VolcatorGuardRole::class);
        $router->aliasMiddleware('permission', \Twedoo\VolcatorGuard\Middleware\VolcatorGuardPermission::class);
        $router->aliasMiddleware('ability', \Twedoo\VolcatorGuard\Middleware\VolcatorGuardAbility::class);
        $routes = $this->app['router']->getRoutes();

        // publish package
        $this->publishes([
            __DIR__.'/../config/volcator.php' => app()->basePath() . '/config/volcator.php',
        ], 'volcator-config');

        $this->publishes([
            __DIR__.'/../resources/views/back' => resource_path('views/back'),
        ], 'volcator-views');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang'),
        ], 'volcator-lang');

        $this->commands('command.volcator.migration');
        $this->commands('command.volcator.seeder');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filesystems.php', 'disks');
        $this->mergeConfigFrom(__DIR__.'/../config/volcator.php', 'volcator');
        $this->mergeConfigFrom(__DIR__.'/../config/prefix.php', 'prefix');
        $this->mergeConfigFrom(__DIR__.'/../config/languages.php', 'languages');
        $this->app->register(VolcatorRouteServiceProvider::class);
        $this->app->register(VolcatorMailServiceProvider::class);
        $this->app->register(VolcatorEventServiceProvider::class);
        $this->app->register(VolcatorTranslationServiceProvider::class);
        $this->app->register(VolcatorGuardServiceProvider::class);
        $this->app->register(VolcatorEventServiceProvider::class);
        $this->registerVolcator();
        $this->registerCommands();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerVolcator()
    {

        $this->app->singleton('volcatorEngine', function () {
            return new VolcatorEngine();
        });
        $this->app->singleton('volcatorStructure', function () {
            return new VolcatorStructure();
        });
        $this->app->bind('volcatorMediaStyle', function() {
            return new VolcatorMediaStyle();
        });
        $this->app->singleton('volcatorFile', function () {
            return new VolcatorFile();
        });
        $this->app->singleton('volcatorLanguage', function () {
            return new VolcatorLanguage();
        });
        $this->app->singleton('volcatorMenu', function () {
            return new VolcatorMenu();
        });
        $this->app->singleton('volcatorPath', function () {
            return new VolcatorPath();
        });
        $this->app->singleton('volcatorTranslation', function () {
            return new VolcatorTranslation();
        });
        $this->app->singleton('volcatorApplication', function () {
            return new VolcatorApplication();
        });
        $this->app->singleton('volcatorSpace', function () {
            return new VolcatorSpace();
        });
        $this->app->singleton('volcatorInvitation', function () {
            return new VolcatorInvitation();
        });
        $this->app->singleton('volcatorEmailNotification', function () {
            return new VolcatorEmailNotification(null);
        });
        $this->app->singleton('volcatorPushNotification', function () {
            return new VolcatorPushNotification();
        });
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.volcator.migration', function ($app) {
            return new MigrationCommand();
        });

        $this->app->singleton('command.volcator.seeder', function ($app) {
            return new SeederCommand();
        });
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/volcator.php' => config_path('volcator.php'),
        ], 'volcator.config');

        $this->publishes([
            __DIR__.'/../config/volcator.php' => app()->basePath() . '/config/filesystems.php',
        ], 'disks');
    }
}
