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
**/
Route::get('admin', function(){
    return view('admin');
});

Route::get('/', function(){
    return view('home');
});

/*
| Blogs routes
*/
Route::get('blogs/category/{category}','web\PostController@indexCategory');
Route::get('blogs/{url_title}', "web\PostController@getFromTitle");
Route::resource('blogs', "web\PostController");

Route::get('test', function(){
    return view('test');
});

/*
| Jobs routes
*/
Route::get('jobs/opening', function(){
    return view('job.opening');
});

Route::resource('jobs','web\JobController');

/* JONATHAN ROUTE */

Route::post('register', 'web\RegisterController@index');
Route::post('login', 'web\LoginController@index');

Route::get('logout', 'web\LogoutController@index');
Route::get('register-token/{token}', 'web\RegisterController@checkToken');

/* JONATHAN ROUTE */