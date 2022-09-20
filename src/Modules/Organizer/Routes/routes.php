<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::auth();

    Route::group(['prefix' => app('urlBack')], function () {
        Route::group([
                'module' => 'Organizer',
                'middleware' => [
                    'web',
                    'permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')
                ],
                'namespace' => 'Twedoo\Stone\Organizer'
            ], function () {

            Route::get('/link', function () {
                $target = app_path('Modules/');
                $shortcut = storage_path('app/public/file/Modules');
                symlink($target, $shortcut);
            });
            Route::get('organizer/module/pre/{module?}/full/now/{isInstallAsMain?}',
                [
                    'as' => app('urlBack') . '.pre.module.building',
                    'uses' => 'Organizer@preBuilding',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
            Route::get('organizer/module/set/{module}/full/now',
                [
                    'as' => app('urlBack') . '.set.module.building',
                    'uses' => 'Organizer@setBuilding',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
            Route::get('organizer/modules',
                [
                    'as' => app('urlBack') . '.super.modules.index',
                    'uses' => 'Organizer@index',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
            Route::post('organizer/upload/modules',
                [
                    'as' => app('urlBack') . '.super.modules.upload',
                    'uses' => 'Organizer@uploadzip',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
            Route::get('organizer/modules/parametres/{id}/{module}/',
                [
                    'as' => app('urlBack') . '.super.module.parametres',
                    'uses' => 'Organizer@parametres',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
            Route::get('organizer/reset/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.reset',
                    'uses' => 'Organizer@resetModule',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
            Route::get('organizer/uninstall/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.uninstall',
                    'uses' => 'Organizer@uninstallModule',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
            Route::get('organizer/enable/moules/{id}/{module}',
                [
                    'as' => app('urlBack') . '.super.module.status',
                    'uses' => 'Organizer@statusModule',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
            Route::get('organizer/remove/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.remove',
                    'uses' => 'Organizer@removeModule',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_MANAGER_ORGANIZER_FULL')]
                ]);
        });
    });
});
