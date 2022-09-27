<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => app('urlBack')], function () {
        Route::group(array('module' => 'Vue', 'middleware' => ['web', 'permission:'. Config::get('stone.PERMISSION_STONE_VUE')], 'namespace' => 'Modules\Vue\Controllers'), function () {
            Route::get('vue/builder',
                [
                    'as' => app('urlBack') . '.stone.vue.index',
                    'uses' => 'Vue@index',
                    'middleware' => ['permission:'. Config::get('stone.PERMISSION_STONE_VUE')]
                ]);
        });
    });
});
