<?php

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::auth();

    Route::group(['prefix' => app('urlBack') . '/' . app('module')], function () {


//protected Languages

        Route::group(array('module' => 'Configurations', 'middleware' => ['web', 'permission:role-access-languages'], 'namespace' => 'Modules\Configurations\Controllers\Languages'), function () {
            //routes languages
            Route::get('languages',
                [
                    'as' => app('urlBack') . '.languages.cms.index',
                    'uses' => '\Modules\Configurations\Controllers\Languages\Languages@index',
                    'middleware' => ['permission:role-access-languages']
                ]);

            Route::get('languages/frontlang',
                [
                    'as' => app('urlBack') . '.languages.cms.frontlang',
                    'uses' => '\Modules\Configurations\Controllers\Languages\Languages@frontlang',
                    'middleware' => ['permission:role-access-languages']
                ]);

            Route::post('languages/frontlang',
                [
                    'as' => app('urlBack') . '.languages.translate.setword',
                    'uses' => '\Modules\Configurations\Controllers\Languages\Languages@setWrod',
                    'middleware' => ['permission:role-access-languages']
                ]);

            Route::get('languages/backlang',
                [
                    'as' => app('urlBack') . '.languages.cms.backlang',
                    'uses' => '\Modules\Configurations\Controllers\Languages\Languages@backlang',
                    'middleware' => ['permission:role-access-languages']
                ]);

            Route::get('languages/backlang/tanslate',
                [
                    'as' => app('urlBack') . '.languages.module.tranlate',
                    'uses' => '\Modules\Configurations\Controllers\Languages\Languages@getTranslate',
                    'middleware' => ['permission:role-access-languages']
                ]);


            Route::get('languages/backlang/tanslate/{table}/edit/{lang}',
                [
                    'as' => app('urlBack') . '.languages.cms.intranlate',
                    'uses' => '\Modules\Configurations\Controllers\Languages\Languages@intranslate',
                    'middleware' => ['permission:role-access-languages']
                ]);


        });
//end protected Languages


//protected Configuration Global

        Route::group(array('module' => 'Configurations', 'middleware' => ['web', 'permission:role-access-settings'], 'namespace' => 'Modules\Configurations\Controllers\Settings'), function () {

            //routes languages cms
            Route::get('settings',
                [
                    'as' => app('urlBack') . '.config.settings.index',
                    'uses' => '\Modules\Configurations\Controllers\Settings\Settings@index',
                    'middleware' => ['permission:role-access-settings']
                ]);

            Route::post('settings',
                [
                    'as' => app('urlBack') . '.config.settings.index',
                    'uses' => '\Modules\Configurations\Controllers\Settings\Settings@create',
                    'middleware' => ['permission:role-access-settings']
                ]);


        });
//end protected Configuration Global


//protected Configuration Global

        Route::group(array('module' => 'Configurations', 'middleware' => ['web', 'permission:role-access-templates'], 'namespace' => 'Modules\Configurations\Controllers\Templates'), function () {

//routes languages cms
//  Route::get('templates',
//  [
//    'as'=>app('urlBack').'.config.settings.index',
//    'uses'=>'\Modules\Configurations\Controllers\Templates\Templates@index',
//    'middleware' => ['permission:role-access-languages']
//  ]);
//
//  Route::post('settings',
//  [
//    'as'=>app('urlBack').'.config.settings.create',
//    'uses'=>'\Modules\Configurations\Controllers\Settings\Settings@create',
//    'middleware' => ['permission:role-access-languages']
//  ]);


        });
//end protected Configuration Global

    });//end protected All routes

});//end global web midlleware
