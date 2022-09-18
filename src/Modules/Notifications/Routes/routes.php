<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use Twedoo\Stone\Core\StonePushNotification;
use Twedoo\Stone\Modules\Notifications\Events\NotificationBroadcast;

Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['web', 'auth']], function () {
        Route::get('/push-notification', function () {
            $user = \Twedoo\StoneGuard\Models\User::find(1);
            StonePushNotification::notify($user, StonePushNotification::NOTIFICATION_MESSAGE_SIMPLE, "test");
//            broadcast(new NotificationBroadcast($user, 'fgfgfg'));
            dump('Event fired ddd.');
        });
    });


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
