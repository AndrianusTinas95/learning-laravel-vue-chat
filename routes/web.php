<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('api/users','Api\V1\UsersController@index');
Route::post('api/messages','Api\V1\MessagesController@index');
Route::post('api/messages/send','Api\V1\MessagesController@store');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
