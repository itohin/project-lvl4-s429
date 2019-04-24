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
});
