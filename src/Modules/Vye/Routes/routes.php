<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => app('urlBack')], function () {

        Route::group([
            'module' => 'Vye',
            'middleware' => ['web', 'permission:'. Config::get('volcator.PERMISSION_VOLCATOR_VYE')],
            'namespace' => 'Modules\Vye\Controllers'], function () {
            Route::get('builder/vye',
                [
                    'as' => app('urlBack') . '.volcator.vye.index',
                    'uses' => 'Vye@index',
                    'middleware' => ['permission:'. Config::get('volcator.PERMISSION_VOLCATOR_VYE')]
                ])->where('any', '.*');

            Route::get('builder/vye/preview/{volcator_application}/{application}',
                [
                    'as' => app('urlBack') . '.volcator.vye.preview',
                    'uses' => 'Vye@preview',
                    'middleware' => ['permission:' . Config::get('volcator.PERMISSION_VOLCATOR_VYE')]
                ]);
        });

    });
});

