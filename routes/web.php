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
        if (Auth::gest())
            return redirect()->route('login');
        return view('home');
    });

    Route::get('/home', 'HomeController@index')->name('home');
});

