<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => [  'api', 'cors']], function () {
    Route::group(['prefix' => app('urlBack')], function () {
        Route::group([
            'module' => 'Vye',
//            'middleware' => [
//                'permission:' . Config::get('volcator.PERMISSION_VOLCATOR_VYE'),
//            ],
            'namespace' => 'Modules\Vye\Controllers'
        ], function () {
            Route::get('/vye/application/{current_application_core_id}/{application_vye_id}', [
                'as' => app('urlBack') . '.vye.api.assignVyeToCurrentApplication',
                'uses' => 'VyeApi@assignVyeToCurrentApplication',
//                'middleware' => [
//                    'permission:' . Config::get('volcator.PERMISSION_VOLCATOR_VYE'),
//                ],
            ]);
        });
    });
});

