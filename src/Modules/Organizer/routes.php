<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::auth();
    Route::group(['prefix' => app('urlBack')], function () {
        Route::group(array('module' => 'Organizer', 'middleware' => ['web', 'permission:role-organizer-stones'], 'namespace' => 'Twedoo\Stone\Organizer'), function () {

            Route::get('/link', function () {
                $target = app_path('Modules/');
                $shortcut = storage_path('app/public/file/Modules');
                symlink($target, $shortcut);
            });
            Route::get('organizer/module/pre/{module}/full/now',
                [
                    'as' => app('urlBack') . '.pre.module.building',
                    'uses' => 'Organizer@preBuilding',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
            Route::get('organizer/module/set/{module}/full/now',
                [
                    'as' => app('urlBack') . '.set.module.building',
                    'uses' => 'Organizer@setBuilding',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
            Route::get('organizer/modules',
                [
                    'as' => app('urlBack') . '.super.modules.index',
                    'uses' => 'Organizer@index',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
            Route::post('organizer/upload/modules',
                [
                    'as' => app('urlBack') . '.super.modules.upload',
                    'uses' => 'Organizer@uploadzip',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
            Route::get('organizer/modules/parametres/{id}/{module}/',
                [
                    'as' => app('urlBack') . '.super.module.parametres',
                    'uses' => 'Organizer@parametres',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
            Route::get('organizer/reset/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.reset',
                    'uses' => 'Organizer@resetModule',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
            Route::get('organizer/uninstall/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.uninstall',
                    'uses' => 'Organizer@uninstallModule',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
            Route::get('organizer/enable/moules/{id}/{module}',
                [
                    'as' => app('urlBack') . '.super.module.status',
                    'uses' => 'Organizer@statusModule',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
            Route::get('organizer/remove/moules/{module}',
                [
                    'as' => app('urlBack') . '.super.module.remove',
                    'uses' => 'Organizer@removeModule',
                    'middleware' => ['permission:role-organizer-stones']
                ]);
        });
    });
});
