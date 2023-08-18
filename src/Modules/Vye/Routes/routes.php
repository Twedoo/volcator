<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => app('urlBack')], function () {
        Route::group(array(
            'module' => 'Vye',
            'middleware' => ['web', 'permission:'. Config::get('volcator.PERMISSION_VOLCATOR_VYE')],
            'namespace' => 'Modules\Vye\Controllers'), function () {
            Route::get('builder/vye/{any?}',
                [
                    'as' => app('urlBack') . '.volcator.vye.index',
                    'uses' => 'Vye@index',
                    'middleware' => ['permission:'. Config::get('volcator.PERMISSION_VOLCATOR_VYE')]
                ])->where('any', '.*');
        });
    });
});
