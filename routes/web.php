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

Route::get('blog/category/{category}','web\PostController@indexCategory');
Route::get('blog/{url_title}', "web\PostController@getFromTitle");
Route::get('blog', "web\PostController@index");
Route::get('test', function(){
    return view('test');
});
