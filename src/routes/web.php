<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);
Route::group(['middlewareGroups' => ['web']], function () {
    Route::group(['prefix' => app('urlBack')], function () {
        Auth::routes();
        Route::get('logout', 'Auth\LoginController@logout');
        Route::group(['middleware' => ['auth']], function () {
            Route::get('/', function () {
                return view('elements.welcome');
            });
            Route::get('users',
                [
                    'as' => app('urlBack') . '.super.users.index',
                    'uses' => 'UserController@index',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
            Route::get('users/live-search',
                [
                    'as' => app('urlBack') . '.super.users.live-search',
                    'uses' => 'UserController@liveSearch',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
             Route::get('users/create',
                [
                    'as' => app('urlBack') . '.super.users.create',
                    'uses' => 'UserController@create',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
            Route::post('users/create',
                [
                    'as' => app('urlBack') . '.super.users.store',
                    'uses' => 'UserController@store',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
            Route::get('users/show/{id}',
                [
                    'as' => app('urlBack') . '.super.users.show',
                    'uses' => 'UserController@show',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
            Route::get('users/{id}/edit',
                [
                    'as' => app('urlBack') . '.super.users.edit',
                    'uses' => 'UserController@edit',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
            Route::patch('users/{id}',
                [
                    'as' => app('urlBack') . '.super.users.update',
                    'uses' => 'UserController@update',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
            Route::get('users/{id}/delete/{level?}',
                [
                    'as' => app('urlBack') . '.super.users.destroy',
                    'uses' => 'UserController@destroy',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_USER_ACCESS_CONTROL')]
                ]);
            //routes Roles
            Route::get('roles',
                [
                    'as' => app('urlBack') . '.super.roles.index',
                    'uses' => 'RoleController@index',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_ROLE_ACCESS_CONTROL')]
                ]);
            Route::get('roles/create',
                [
                    'as' => app('urlBack') . '.super.roles.create',
                    'uses' => 'RoleController@create',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_ROLE_ACCESS_CONTROL')]
                ]);
            Route::post('roles/create',
                [
                    'as' => app('urlBack') . '.super.roles.store',
                    'uses' => 'RoleController@store',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_ROLE_ACCESS_CONTROL')]
                ]);
            Route::get('roles/show/{id}',
                [
                    'as' => app('urlBack') . '.super.roles.show',
                    'uses' => 'RoleController@show',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_ROLE_ACCESS_CONTROL')]
                ]);
            Route::get('roles/{id}/edit',
                [
                    'as' => app('urlBack') . '.super.roles.edit',
                    'uses' => 'RoleController@edit',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_ROLE_ACCESS_CONTROL')]
                ]);
            Route::patch('roles/{id}',
                [
                    'as' => app('urlBack') . '.super.roles.update',
                    'uses' => 'RoleController@update',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_ROLE_ACCESS_CONTROL')]
                ]);
            Route::get('roles/{id}/delete',
                [
                    'as' => app('urlBack') . '.super.roles.destroy',
                    'uses' => 'RoleController@destroy',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_ROLE_ACCESS_CONTROL')]
                ]);
            //routes Permission
            Route::get('permissions',
                [
                    'as' => app('urlBack') . '.super.permissions.index',
                    'uses' => 'PermissionController@index',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_PERMISSION_ACCESS_CONTROL')]
                ]);
            Route::get('permissions/create',
                [
                    'as' => app('urlBack') . '.super.permissions.create',
                    'uses' => 'PermissionController@create',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_PERMISSION_ACCESS_CONTROL')]
                ]);
            Route::post('permissions/create',
                [
                    'as' => app('urlBack') . '.super.permissions.store',
                    'uses' => 'PermissionController@store',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_PERMISSION_ACCESS_CONTROL')]
                ]);
            Route::get('permissions/{id}/edit',
                [
                    'as' => app('urlBack') . '.super.permissions.edit',
                    'uses' => 'PermissionController@edit',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_PERMISSION_ACCESS_CONTROL')]
                ]);
            Route::patch('permissions/{id}',
                [
                    'as' => app('urlBack') . '.super.permissions.update',
                    'uses' => 'PermissionController@update',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_PERMISSION_ACCESS_CONTROL')]
                ]);
            Route::get('permissions/{id}/delete',
                [
                    'as' => app('urlBack') . '.super.permissions.destroy',
                    'uses' => 'PermissionController@destroy',
                    'middleware' => ['permission:'.Config::get('stone.PERMISSION_PERMISSION_ACCESS_CONTROL')]
                ]);
        });
    });
});
