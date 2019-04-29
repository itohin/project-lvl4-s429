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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => '/users'], function () {
    Route::get('/', 'UserController@index')->name('users.index');

    Route::group(['prefix' => '/{user}'], function () {
        Route::get('/edit', 'UserController@edit')->name('users.edit');
        Route::patch('/', 'UserController@update')->name('users.update');
        Route::delete('/', 'UserController@destroy')->name('users.delete');
    });
});

Route::group(['prefix' => '/tasks'], function () {
    Route::get('/', 'TaskController@index')->name('tasks.index');
    Route::get('/create', 'TaskController@create')->name('tasks.create');
    Route::post('/store', 'TaskController@store')->name('tasks.store');

    Route::group(['prefix' => '/{task}'], function () {
        Route::get('/show', 'TaskController@show')->name('tasks.show');
        Route::get('/edit', 'TaskController@edit')->name('tasks.edit');
        Route::patch('/update', 'TaskController@update')->name('tasks.update');
        Route::delete('/', 'TaskController@delete')->name('tasks.delete');
    });
});

Route::group(['prefix' => '/status'], function () {
    Route::get('/', 'StatusController@index')->name('status.index');
    Route::get('/create', 'StatusController@create')->name('status.create');
    Route::post('/store', 'StatusController@store')->name('status.store');

    Route::group(['prefix' => '/{status}'], function () {
        Route::get('/edit', 'StatusController@edit')->name('status.edit');
        Route::patch('/update', 'StatusController@update')->name('status.update');
        Route::delete('/', 'StatusController@destroy')->name('status.delete');
    });
});
