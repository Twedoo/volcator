<?php
//
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::auth();
    Route::group(['prefix' => app('urlBack') . '/' . app('module')], function () {
        /**
         * Routes of Multi-Applications
         */
        Route::group([
            'module' => 'Applications',
            'middleware' => [
                'web',
                'permission:permissions-applications-view'
            ],
            'namespace' => 'Modules\Applications\Controllers'
        ], function () {
            Route::get('applications',
                [
                    'as' => app('urlBack') . '.multi.applications.index',
                    'uses' => 'MultiApplications@index',
                    'middleware' => ['permission:permissions-applications-view']
                ]);
            Route::get('applications/create',
                [
                    'as' => app('urlBack') . '.multi.applications.create',
                    'uses' => 'MultiApplications@create',
                    'middleware' => ['permission:permissions-applications-create']
                ]);
            Route::post('applications/create',
                [
                    'as' => app('urlBack') . '.multi.applications.create',
                    'uses' => 'MultiApplications@store',
                    'middleware' => ['permission:permissions-applications-create']
                ]);
            Route::get('applications/{id}/edit',
                [
                    'as' => app('urlBack') . '.multi.applications.edit',
                    'uses' => 'MultiApplications@edit',
                    'middleware' => ['permission:permissions-applications-create']
                ]);
            Route::get('applications/{id}/delete',
                [
                    'as' => app('urlBack') . '.multi.applications.delete',
                    'uses' => 'MultiApplications@destroy',
                    'middleware' => ['permission:permissions-applications-delete']
                ]);
            Route::get('applications/type',
                [
                    'as' => app('urlBack') . '.multi.applications.type',
                    'uses' => 'MultiApplications@createType',
                    'middleware' => ['permission:permissions-applications-type']
                ]);
            Route::post('applications/type',
                [
                    'as' => app('urlBack') . '.multi.applications.type',
                    'uses' => 'MultiApplications@storeType',
                    'middleware' => ['permission:permissions-applications-type']
                ]);
        });
    });
    /**
     * End Routes of Multi-Applications
     */
});
