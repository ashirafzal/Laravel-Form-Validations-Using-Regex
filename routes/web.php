<?php

Route::get('/', function () { return view('welcome'); });

Route::middleware('auth')->group(function () {

    Route::get('/post', function () { return view('post'); });

    Route::get('/user', function () { return view('user'); });

    Route::post('create-post', '\App\Http\Controllers\WebsiteController@CreatePost');

    Route::post('create-user', '\App\Http\Controllers\WebsiteController@CreateUser');

    Route::post('edit-post', '\App\Http\Controllers\WebsiteController@EditPost');

    Route::post('edit-user', '\App\Http\Controllers\WebsiteController@EditUser');

    Route::get('destroy/{id}', '\App\Http\Controllers\WebsiteController@destroy');

    Route::get('Userdestroy/{id}', '\App\Http\Controllers\WebsiteController@Userdestroy');

    Route::get('post/{id}', '\App\Http\Controllers\WebsiteController@ViewPost');

    Route::get('user/{id}', '\App\Http\Controllers\WebsiteController@ViewUser');

    Route::get('check', '\App\Http\Controllers\WebsiteController@check');

    Route::get('check2', '\App\Http\Controllers\WebsiteController@check2');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
