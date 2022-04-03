<?php
// MyVendor\contactform\src\routes\web.php
Route::get('/contact', function(){
    return 'Hello from the contact form package';
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);


Route::group(['middlewareGroups' => ['web']], function () {

    Route::group(['prefix' => app('urlBack')], function () {
        Auth::routes();
        Route::get('logout', 'Auth\LoginController@logout');
        Route::group(['middleware' => ['auth']], function () {
            Route::get('/', function () {
                return view('elements.welcome');
            });
            //begin protected module super admin routes
            Route::group(['middleware' => ['permission:role-access-controle']], function () {
                //routes Users
                Route::get('users',
                    [
                        'as' => app('urlBack') . '.super.users.index',
                        'uses' => 'UserController@index',
                        'middleware' => ['permission:users-access']
                    ]);
                Route::get('users/create',
                    [
                        'as' => app('urlBack') . '.super.users.create',
                        'uses' => 'UserController@create',
                        'middleware' => ['permission:users-access']
                    ]);
                Route::post('users/create',
                    [
                        'as' => app('urlBack') . '.super.users.store',
                        'uses' => 'UserController@store',
                        'middleware' => ['permission:users-access']
                    ]);
                Route::get('users/show/{id}',
                    [
                        'as' => app('urlBack') . '.super.users.show',
                        'uses' => 'UserController@show',
                        'middleware' => ['permission:users-access']
                    ]);
                Route::get('users/{id}/edit',
                    [
                        'as' => app('urlBack') . '.super.users.edit',
                        'uses' => 'UserController@edit',
                        'middleware' => ['permission:users-access']
                    ]);
                Route::patch('users/{id}',
                    [
                        'as' => app('urlBack') . '.super.users.update',
                        'uses' => 'UserController@update',
                        'middleware' => ['permission:users-access']
                    ]);
                Route::get('users/{id}/delete',
                    [
                        'as' => app('urlBack') . '.super.users.destroy',
                        'uses' => 'UserController@destroy',
                        'middleware' => ['permission:users-access']
                    ]);
                //routes Roles
                Route::get('roles',
                    [
                        'as' => app('urlBack') . '.super.roles.index',
                        'uses' => 'RoleController@index',
                        'middleware' => ['permission:roles-access']
                    ]);
                Route::get('roles/create',
                    [
                        'as' => app('urlBack') . '.super.roles.create',
                        'uses' => 'RoleController@create',
                        'middleware' => ['permission:roles-access']
                    ]);
                Route::post('roles/create',
                    [
                        'as' => app('urlBack') . '.super.roles.store',
                        'uses' => 'RoleController@store',
                        'middleware' => ['permission:roles-access']
                    ]);
                Route::get('roles/show/{id}',
                    [
                        'as' => app('urlBack') . '.super.roles.show',
                        'uses' => 'RoleController@show',
                        'middleware' => ['permission:roles-access']
                    ]);
                Route::get('roles/{id}/edit',
                    [
                        'as' => app('urlBack') . '.super.roles.edit',
                        'uses' => 'RoleController@edit',
                        'middleware' => ['permission:roles-access']
                    ]);
                Route::patch('roles/{id}',
                    [
                        'as' => app('urlBack') . '.super.roles.update',
                        'uses' => 'RoleController@update',
                        'middleware' => ['permission:roles-access']
                    ]);
                Route::get('roles/{id}/delete',
                    [
                        'as' => app('urlBack') . '.super.roles.destroy',
                        'uses' => 'RoleController@destroy',
                        'middleware' => ['permission:roles-access']
                    ]);
                //routes Permission
                Route::get('permissions',
                    [
                        'as' => app('urlBack') . '.super.permissions.index',
                        'uses' => 'PermissionController@index',
                        'middleware' => ['permission:permissions-access']
                    ]);
                Route::get('permissions/create',
                    [
                        'as' => app('urlBack') . '.super.permissions.create',
                        'uses' => 'PermissionController@create',
                        'middleware' => ['permission:permissions-access']
                    ]);
                Route::post('permissions/create',
                    [
                        'as' => app('urlBack') . '.super.permissions.store',
                        'uses' => 'PermissionController@store',
                        'middleware' => ['permission:permissions-access']
                    ]);
                Route::get('permissions/{id}/edit',
                    [
                        'as' => app('urlBack') . '.super.permissions.edit',
                        'uses' => 'PermissionController@edit',
                        'middleware' => ['permission:permissions-access']
                    ]);
                Route::patch('permissions/{id}',
                    [
                        'as' => app('urlBack') . '.super.permissions.update',
                        'uses' => 'PermissionController@update',
                        'middleware' => ['permission:permissions-access']
                    ]);
                Route::get('permissions/{id}/delete',
                    [
                        'as' => app('urlBack') . '.super.permissions.destroy',
                        'uses' => 'PermissionController@destroy',
                        'middleware' => ['permission:permissions-access']
                    ]);
            });
            //end protected module super admin routes
        });// auth
    });// prefix
});//end global web midlleware
