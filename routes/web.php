<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', function () {
        if (Auth::guest())
            return redirect()->route('login');
        return view('home');
    });

    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('projects', 'ProjectController');
    Route::resource('users', 'UserController');
    Route::get('/collaborating', 'ProjectController@collaborating')->name('collaborating_projects');
    Route::post('/joinProject/{id}', 'ProjectController@join')->name('join_project');
    Route::post('/leaveProject/{id}', 'ProjectController@leave')->name('leave_project');
    Route::post('/finishProject/{id}', 'ProjectController@finish')->name('finish_project');
    Route::get('/manage_users','UserController@getAllUsers')->name('manage_users');
    Route::get('/downloadDocument/{id}', 'ProjectController@downloadDocument');
    Route::get('/deactivate_user/{id}', 'UserController@deactivateUser')->name('deactivate_user');
    Route::get('/activate_user/{id}', 'UserController@activateUser')->name('activate_user');


});

