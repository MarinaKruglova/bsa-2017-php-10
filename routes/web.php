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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/cars'], function() {
    Route::get('/', 'CarController@index')->name('cars-list');
    Route::get('/create', 'CarController@create')->name('car-form');

    Route::get('/{id}', 'CarController@show')->name('car-show');
    Route::get('/{id}/edit', 'CarController@edit')->name('car-edit');
    Route::post('/{id}', 'CarController@update')->name('car-update');

    Route::post('/', 'CarController@store')->name('car-store');
});