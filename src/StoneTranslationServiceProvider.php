<?php

namespace Twedoo\Stone;

use Illuminate\Support\ServiceProvider;

class StoneTranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $stoneModules = glob(__DIR__.'/Modules' . '/*', GLOB_ONLYDIR);
        foreach ($stoneModules as $key => $value) {
            list(, $GetFolderModules) = explode(__DIR__.'/Modules/', $value);
            $this->loadTranslationsFrom(__DIR__.'/Modules/' . $GetFolderModules . '/lang', '' . $GetFolderModules . '');
        }

        $appModules = glob(base_path() . '/app/Modules/*', GLOB_ONLYDIR);
        foreach ($appModules as $key => $value) {
            list(, $GetFolderModules) = explode(base_path() . '/app/Modules/', $value);
            $this->loadTranslationsFrom(base_path() . '/app/Modules/' . $GetFolderModules . '/lang', '' . $GetFolderModules . '');
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
