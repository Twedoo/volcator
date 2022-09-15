<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => 'invite/'.app('urlBack')], function () {

        Route::group([
            'module' => 'Notifications',
            'namespace' => 'Modules\Notifications\Controllers'
        ], function () {
            Route::get('/create-user/{code}/{identification?}',
                [
                    'as' => 'invite.user.preCreateUser',
                    'uses' => 'Notifications@preCreateUser'
                ]);
            Route::post('/create-user/{code}/{identification?}',
                [
                    'as' => 'invite.user.createUser',
                    'uses' => 'Notifications@createUser'
                ]);
            Route::post( '/users',
                [
                    'as' => 'invite.users.invite',
                    'uses' => 'Notifications@invite',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
        });
    });

    Route::group(['prefix' => app('urlBack')], function () {

        Route::group([
            'module' => 'Notifications',
            'namespace' => 'Modules\Notifications\Controllers'
        ], function () {
            Route::get('/list/notifications',
                [
                    'as' => 'notification.user.index',
                    'uses' => 'Notifications@index'
                ]);
        });
    });
});
