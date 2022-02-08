<?php

namespace Twedoo\Stone;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Twedoo\Stone\Core\StoneLanguage;
use Twedoo\Stone\Core\StoneMenu;
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
        $router->pushMiddlewareToGroup('web', Language::class);
        $router->aliasMiddleware('role', \Twedoo\StoneGuard\Middleware\StoneGuardRole::class);
        $router->aliasMiddleware('permission', \Twedoo\StoneGuard\Middleware\StoneGuardPermission::class);
        $router->aliasMiddleware('ability', \Twedoo\StoneGuard\Middleware\StoneGuardAbility::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/stone.php', 'stone');
        $this->mergeConfigFrom(__DIR__.'/../config/prefix.php', 'prefix');
        $this->mergeConfigFrom(__DIR__.'/../config/languages.php', 'languages');
        $this->app->register(StoneRouteServiceProvider::class);
        $this->app->register(StoneTranslationServiceProvider::class);
        $this->app->register(StoneGuardServiceProvider::class);
        $this->registerStone();
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
    }

//    /**
//     * Get the services provided by the provider.
//     *
//     * @return array
//     */
//    public function provides()
//    {
//        return ['stone', 'command.entrust.migration'];
//    }

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

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/twedoo'),
        ], 'stone.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/twedoo'),
        ], 'stone.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/twedoo'),
        ], 'stone.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
