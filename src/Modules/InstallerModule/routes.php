<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::auth();
    Route::group(['prefix' => app('urlBack')], function () {
        Route::group(array('module' => 'InstallerModule', 'middleware' => ['web', 'permission:role-access-modules'], 'namespace' => 'Twedoo\Stone\InstallerModule'), function () {

            Route::get('/link', function () {
                $target = app_path('Modules/');
                $shortcut = storage_path('app/public/file/Modules');
                symlink($target, $shortcut);
            });
            Route::get('pre/{module}/full/now',
                [
                    'as' => app('urlBack') . '.pre.module.building',
                    'uses' => 'InstallerModule@preBuilding',
                    'middleware' => ['permission:role-access-modules']
                ]);
            Route::get('set/{module}/full/now',
                [
                    'as' => app('urlBack') . '.set.module.building',
                    'uses' => '\Modules\InstallModule\InstallerModule@setBuilding',
                    'middleware' => ['permission:role-access-modules']
                ]);
            Route::get('install/modules',
                [
                    'as' => app('urlBack') . '.super.modules.index',
                    'uses' => 'InstallerModule@index',
                    'middleware' => ['permission:role-access-modules']
                ]);
            Route::post('upload/modules',
                [
                    'as' => app('urlBack') . '.super.modules.upload',
                    'uses' => 'InstallerModule@uploadzip',
                    'middleware' => ['permission:role-access-modules']
                ]);
            Route::get('modules/parametres/{id}/{module}/',
                [
                    'as' => app('urlBack') . '.super.module.parametres',
                    'uses' => 'InstallerModule@parametres',
                    'middleware' => ['permission:role-access-modules']
                ]);
            Route::get('reset/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.reset',
                    'uses' => 'InstallerModule@resetModule',
                    'middleware' => ['permission:role-access-modules']
                ]);
            Route::get('uninstall/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.uninstall',
                    'uses' => 'InstallerModule@uninstallModule',
                    'middleware' => ['permission:role-access-modules']
                ]);
            Route::get('enable/moules/{id}/{module}',
                [
                    'as' => app('urlBack') . '.super.module.status',
                    'uses' => 'InstallerModule@statusModule',
                    'middleware' => ['permission:role-access-modules']
                ]);
            Route::get('remove/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.remove',
                    'uses' => 'InstallerModule@removeModule',
                    'middleware' => ['permission:role-access-modules']
                ]);
        });
    });
});
