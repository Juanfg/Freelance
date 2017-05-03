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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('register', 'ApiController@register');
Route::get('login', 'ApiController@login');

Route::get('getAllProjects', 'ApiController@getAllProjects');
Route::get('getJoinedProjects', 'ApiController@getJoinedProjects');
Route::get('getNotJoinedProjects', 'ApiController@getNotJoinedProjects');
Route::get('getMyProjects', 'ApiController@getMyProjects');
Route::get('getProject', 'ApiController@getProject');
Route::get('getAllCategories', 'ApiController@getAllCategories');
Route::get('createProject', 'ApiController@createProject');
Route::get('updateProject', 'ApiController@updateProject');
Route::get('getUser', 'ApiController@getUser');
Route::get('updateUser', 'ApiController@updateUser');
Route::get('joinProject', 'ApiController@joinProject');
