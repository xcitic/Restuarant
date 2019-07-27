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
    return view('landing');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/reservation', 'ReservationController@store');

Route::get('/reservations/get', 'ReservationController@show');

Route::post('/message', 'MessageController@store');

Route::get('/messages/get', 'MessageController@index');
