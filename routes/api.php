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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'AuthController@logout');
        Route::post('save-test', 'LessonController@saveTest');
        Route::get('list-test', 'LessonController@getListTest');
    });

    Route::get('research', 'ResearchController@research');
    Route::get('courses/{course}', 'CourseController@getLists');
    Route::apiResource('lessons', 'LessonController');
});
