<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::auth();

    Route::group(['prefix' => app('urlBack')], function () {
        Route::group([
            'module' => 'Applications',
            'middleware' => [
                'web',
                //            'permission:'.Config::get('volcator.PERMISSION_APPLICATION_VIEW')
            ],
            'namespace' => 'Modules\Applications\Controllers'
        ], function () {
            Route::get('/switch/application/{application}', [
                'as' => app('urlBack') . '.application.switch',
                'uses' => 'MultiApplications@switchApplication',
                'middleware' => ['permission:' . Config::get('volcator.PERMISSION_APPLICATION_VIEW')]
            ]);
        });

        Route::group([
            'module' => 'Applications',
            'middleware' => [
                'web',
                //            'permission:'.Config::get('volcator.PERMISSION_SPACE_VIEW')
            ],
            'namespace' => 'Modules\Applications\Controllers'
        ], function () {
            Route::get('/switch/space/{space}', [
                'as' => app('urlBack') . '.space.switch',
                'uses' => 'Spaces@switchSpace',
                'middleware' => ['permission:' . Config::get('volcator.PERMISSION_SPACE_VIEW')]
            ]);
        });

        Route::group([
            'module' => 'Applications',
            'middleware' => [
                'web',
                //                'permission:'.Config::get('volcator.PERMISSION_SPACE_FULL')
            ],
            'namespace' => 'Modules\Applications\Controllers'
        ], function () {
            Route::post('spaces/manager/{id?}',
                [
                    'as' => app('urlBack') . '.store.manager',
                    'uses' => 'Spaces@store',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_SPACE_FULL')]
                ]);
        });
        /**
         * Routes of Multi-Applications
         */
        Route::group([
            'middleware' => [
                'web',
                'permission:'.Config::get('volcator.PERMISSION_APPLICATION_FULL')
            ],
            'namespace' => 'Modules\Applications\Controllers'
        ], function () {

            Route::get('applications',
                [
                    'as' => app('urlBack') . '.multi.applications.index',
                    'uses' => 'MultiApplications@index',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::get('applications/{id}/show',
                [
                    'as' => app('urlBack') . '.multi.applications.show',
                    'uses' => 'MultiApplications@show',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::get('applications/create',
                [
                    'as' => app('urlBack') . '.multi.applications.create',
                    'uses' => 'MultiApplications@create',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::post('applications/create',
                [
                    'as' => app('urlBack') . '.multi.applications.create',
                    'uses' => 'MultiApplications@store',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::get('applications/{id}/edit',
                [
                    'as' => app('urlBack') . '.multi.applications.edit',
                    'uses' => 'MultiApplications@edit',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::patch('applications/{id}/edit',
                [
                    'as' => app('urlBack') . '.multi.applications.edit',
                    'uses' => 'MultiApplications@update',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::get('applications/{id}/delete',
                [
                    'as' => app('urlBack') . '.multi.applications.delete',
                    'uses' => 'MultiApplications@destroy',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_APPLICATION_FULL')]
                ]);
        });
    });
    /**
     * End Routes of Multi-Applications
     */
});
