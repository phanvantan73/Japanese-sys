<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {
	Route::post('login', 'AuthController@login');

	Route::middleware('auth:api')->group(function () {
		Route::post('logout', 'AuthController@logout');
	});
});

// Route::post('/v1/login', 'Api\V1\AuthController@login');
// Route::get('/v1/login', function () {
// 	dd(1234);
// });
