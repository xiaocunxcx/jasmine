<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'Blog\HomeController@index');
Route::get('/articles', 'Blog\ArticleController@index');
Route::get('/secrets', 'Blog\SecretController@index');

Route::get('article/{id}', 'Blog\ArticleController@show');
Route::get('secret/{id}', 'Blog\SecretController@show');
Route::post('comment/store', 'Blog\CommentsController@store');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminHomeController@index');
    Route::resource('articles', 'PagesController');
    Route::resource('comments', 'CommentsController');
});

Route::get('/test', function () {
    return view('welcome');
});