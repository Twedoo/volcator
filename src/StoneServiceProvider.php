<?php

namespace Twedoo\Stone;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Twedoo\Stone\Core\StoneApplication;
use Twedoo\Stone\Core\StoneInvitation;
use Twedoo\Stone\Core\StoneLanguage;
use Twedoo\Stone\Core\StoneMenu;
use Twedoo\Stone\Core\StoneNotification;
use Twedoo\Stone\Core\StoneSpace;
use Twedoo\Stone\Core\StoneStructure;
use Twedoo\Stone\Core\StoneTranslation;
use Twedoo\Stone\Core\Utils\StoneFile;
use Twedoo\Stone\Core\Utils\StonePath;
use Twedoo\Stone\Facades\StoneEngineFacade;
use Twedoo\Stone\Facades\StoneFileFacade;
use Twedoo\Stone\Facades\StoneLanguageFacade;
use Twedoo\Stone\Facades\StoneMediaStyleFacade;
use Twedoo\Stone\Facades\StoneMenuFacade;
use Twedoo\Stone\Facades\StonePathFacade;
use Twedoo\Stone\Facades\StoneTranslationFacade;
use Twedoo\Stone\Http\Middleware\CheckModules;
use Twedoo\Stone\Http\Middleware\Language;
use Twedoo\Stone\Models\Parameters;
use Twedoo\Stone\Core\Utils\StoneMediaStyle;
use Twedoo\StoneGuard\StoneGuardServiceProvider;
use Twedoo\Stone\MigrationCommand;
use Twedoo\Stone\SeederCommand;
use Config;

class StoneServiceProvider extends ServiceProvider
{

//    private $namespace = '\Twedoo\Stone\Http\Controllers';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Will make sure that the required modules have been fully loaded
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot() {
        $router = $this->app->make(Router::class);
//        $router->pushMiddlewareToGroup('web', Language::class);
//        $router->pushMiddlewareToGroup('web', CheckModules::class);
//        $router->pushMiddlewareToGroup('web', \Twedoo\StoneGuard\Middleware\UserEnable::class);
        $router->aliasMiddleware('role', \Twedoo\StoneGuard\Middleware\StoneGuardRole::class);
        $router->aliasMiddleware('permission', \Twedoo\StoneGuard\Middleware\StoneGuardPermission::class);
        $router->aliasMiddleware('ability', \Twedoo\StoneGuard\Middleware\StoneGuardAbility::class);
        $routes = $this->app['router']->getRoutes();

        // publish package
        $this->publishes([
            __DIR__.'/../config/stone.php' => app()->basePath() . '/config/stone.php',
        ], 'stone-config');

        $this->publishes([
            __DIR__.'/../resources/views/back' => resource_path('views/back'),
        ], 'stone-views');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang'),
        ], 'stone-lang');

        $this->commands('command.stone.migration');
        $this->commands('command.stone.seeder');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filesystems.php', 'disks');
        $this->mergeConfigFrom(__DIR__.'/../config/stone.php', 'stone');
        $this->mergeConfigFrom(__DIR__.'/../config/prefix.php', 'prefix');
        $this->mergeConfigFrom(__DIR__.'/../config/languages.php', 'languages');
        $this->app->register(StoneRouteServiceProvider::class);
        $this->app->register(StoneMailServiceProvider::class);
        $this->app->register(StoneEventServiceProvider::class);
        $this->app->register(StoneTranslationServiceProvider::class);
        $this->app->register(StoneGuardServiceProvider::class);
        $this->app->register(StoneEventServiceProvider::class);
        $this->registerStone();
        $this->registerCommands();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerStone()
    {

        $this->app->singleton('stoneEngine', function () {
            return new StoneEngine();
        });
        $this->app->singleton('stoneStructure', function () {
            return new StoneStructure();
        });
        $this->app->bind('stoneMediaStyle', function() {
            return new StoneMediaStyle();
        });
        $this->app->singleton('stoneFile', function () {
            return new StoneFile();
        });
        $this->app->singleton('stoneLanguage', function () {
            return new StoneLanguage();
        });
        $this->app->singleton('stoneMenu', function () {
            return new StoneMenu();
        });
        $this->app->singleton('stonePath', function () {
            return new StonePath();
        });
        $this->app->singleton('stoneTranslation', function () {
            return new StoneTranslation();
        });
        $this->app->singleton('stoneApplication', function () {
            return new StoneApplication();
        });
        $this->app->singleton('stoneSpace', function () {
            return new StoneSpace();
        });
        $this->app->singleton('stoneInvitation', function () {
            return new StoneInvitation();
        });
        $this->app->singleton('stoneNotification', function () {
            return new StoneNotification(null);
        });
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.stone.migration', function ($app) {
            return new MigrationCommand();
        });

        $this->app->singleton('command.stone.seeder', function ($app) {
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
            __DIR__.'/../config/stone.php' => config_path('stone.php'),
        ], 'stone.config');

        $this->publishes([
            __DIR__.'/../config/stone.php' => app()->basePath() . '/config/filesystems.php',
        ], 'disks');
    }
}
