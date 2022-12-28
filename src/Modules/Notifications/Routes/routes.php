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
                    'uses' => 'Invitations@preCreateUser'
                ]);
            Route::post('/create-user/{code}/{identification?}',
                [
                    'as' => 'invite.user.createUser',
                    'uses' => 'Invitations@createUser'
                ]);
            Route::post( '/users',
                [
                    'as' => 'invite.users.invite',
                    'uses' => 'Invitations@invite',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
        });
    });

    Route::group(['prefix' => app('urlBack')], function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::group([
                'module' => 'Notifications',
                'namespace' => 'Modules\Notifications\Controllers'
            ], function () {
                Route::get('/list/notifications',
                    [
                        'as' => app('urlBack').'.notification.user.index',
                        'uses' => 'Notifications@index'
                    ]);
            });
            Route::group([
                'module' => 'Notifications',
                'namespace' => 'Modules\Notifications\Controllers'
            ], function () {
                Route::get('/redirect/notification/actionUrl/{notification}/{space}/{application}/{redirectTo}/{user}',
                    [
                        'as' => app('urlBack') .'.redirect.notification.actionUrl',
                        'uses' => 'Notifications@actionUrl'
                    ]);
            });
        });
    });
});
