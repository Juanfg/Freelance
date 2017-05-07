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
    Route::get('/downloadDocument/{id}', 'ProjectController@downloadDocument');
});

