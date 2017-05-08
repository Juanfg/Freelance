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
    Route::get('/downloadDocument/{id}', 'ProjectController@downloadDocument');
    Route::get('/grade_collaborators', 'ProjectController@grade_collaborators')->name('grade_collaborators');

    Route::get('/manage_users','UserController@getAllUsers')->name('manage_users');
    Route::get('/manage_projects','ProjectController@getAllProjects')->name('manage_projects');
    Route::get('/manage_categories','CategoryController@getAllCategories')->name('manage_categories');
    Route::get('/create_category', 'CategoryController@create')->name('create_category');
    Route::get('/edit_category/{id}', 'CategoryController@edit')->name('edit_category');
    Route::put('/update_category/{id}', 'CategoryController@update_category')->name('update_category');
    Route::post('/store_category','CategoryController@store')->name('store_category');


    Route::get('/deactivate_user/{id}', 'UserController@deactivateUser')->name('deactivate_user');
    Route::get('/activate_user/{id}', 'UserController@activateUser')->name('activate_user');
    Route::get('/deactivate_project/{id}', 'ProjectController@deactivateProject')->name('deactivate_project');
    Route::get('/activate_project/{id}', 'ProjectController@activateProject')->name('activate_project');
    Route::get('/deactivate_category/{id}', 'CategoryController@deactivateCategory')->name('deactivate_category');
    Route::get('/activate_category/{id}', 'CategoryController@activateCategory')->name('activate_category');

    Route::post('/addCollaborator/{id}', 'ProjectController@addCollaborator')->name('add_collaborator');
});

