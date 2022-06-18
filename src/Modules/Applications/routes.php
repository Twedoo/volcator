<?php
//
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::auth();

    Route::group([
        'prefix' => app('urlBack'),
        'module' => 'Applications',
        'middleware' => [
            'web',
            'permission:'.Config::get('stone.PERMISSION_APPLICATION_VIEW')
        ],
        'namespace' => 'Modules\Applications\Controllers'
    ], function () {
        Route::get('/switch/application/{application}', [
            'as' => app('urlBack') . '.application.switch',
            'uses' => 'MultiApplications@switchApplication',
            'middleware' => ['permission:'.Config::get('stone.PERMISSION_APPLICATION_VIEW')]
        ]);
    });

    Route::group([
        'prefix' => app('urlBack'),
        'module' => 'Applications',
        'middleware' => [
            'web',
            'permission:'.Config::get('stone.PERMISSION_SPACE_VIEW')
        ],
        'namespace' => 'Modules\Applications\Controllers'
    ], function () {
        Route::get('/switch/space/{space}', [
            'as' => app('urlBack') . '.space.switch',
            'uses' => 'Spaces@switchSpace',
            'middleware' => ['permission:'.Config::get('stone.PERMISSION_SPACE_VIEW')]
        ]);
    });

    Route::group(['prefix' => app('urlBack') . '/' . app('module')], function () {
        Route::group([
            'module' => 'Applications',
            'middleware' => [
                'web',
                'permission:'.Config::get('stone.PERMISSION_SPACE_FULL')
            ],
            'namespace' => 'Modules\Applications\Controllers'
        ], function () {
            Route::post('spaces/manager/{id?}',
                [
                    'as' => app('urlBack') . '.store.manager',
                    'uses' => 'Spaces@store',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_SPACE_FULL')]
                ]);
        });
        /**
         * Routes of Multi-Applications
         */
        Route::group([
            'module' => 'Applications',
            'middleware' => [
                'web',
                'permission:'.Config::get('stone.PERMISSION_APPLICATION_FULL')
            ],
            'namespace' => 'Modules\Applications\Controllers'
        ], function () {

            Route::get('applications',
                [
                    'as' => app('urlBack') . '.multi.applications.index',
                    'uses' => 'MultiApplications@index',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::get('applications/create',
                [
                    'as' => app('urlBack') . '.multi.applications.create',
                    'uses' => 'MultiApplications@create',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::post('applications/create',
                [
                    'as' => app('urlBack') . '.multi.applications.create',
                    'uses' => 'MultiApplications@store',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::get('applications/{id}/edit',
                [
                    'as' => app('urlBack') . '.multi.applications.edit',
                    'uses' => 'MultiApplications@edit',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::get('applications/{id}/delete',
                [
                    'as' => app('urlBack') . '.multi.applications.delete',
                    'uses' => 'MultiApplications@destroy',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::get('applications/type',
                [
                    'as' => app('urlBack') . '.multi.applications.type',
                    'uses' => 'MultiApplications@createType',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_APPLICATION_FULL')]
                ]);
            Route::post('applications/type',
                [
                    'as' => app('urlBack') . '.multi.applications.type',
                    'uses' => 'MultiApplications@storeType',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_APPLICATION_FULL')]
                ]);
        });
    });
    /**
     * End Routes of Multi-Applications
     */
});
