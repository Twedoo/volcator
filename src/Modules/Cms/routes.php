<?php
//
//Route::group(['middleware' => ['web', 'auth']], function () {
//Route::auth();
//
//Route::group(['prefix' => app('urlBack') . '/' . app('module')], function () {
//
//    Route::group(array('module' => 'Cms', 'middleware' => ['web', 'permission:role-access-cms'], 'namespace' => 'Twedoo\Stone\Cms'), function () {
//        //routes languages cms
//        Route::get('cms-pages',
//            [
//                'as' => app('urlBack') . '.pages.cms.index',
//                'uses' => 'Cms@index',
//                'middleware' => ['permission:role-access-cms-pages']
//            ]);
//    });//   end protected cms config
//
//});//   end protected super admin routes
//});
