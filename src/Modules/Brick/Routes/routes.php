<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => app('urlBack')], function () {
        Route::group(array('module' => 'Brick', 'middleware' => ['web', 'permission:'. Config::get('stone.PERMISSION_STONE_BRICK')], 'namespace' => 'Modules\Brick\Controllers'), function () {
            Route::get('brick/builder',
                [
                    'as' => app('urlBack') . '.stone.brick.index',
                    'uses' => 'Brick@index',
                    'middleware' => ['permission:'. Config::get('stone.PERMISSION_STONE_BRICK')]
                ]);
        });
    });
});
