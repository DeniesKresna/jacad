<?php

use Illuminate\Support\Facades\Route;

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

/*
| Pages routes
*/
Route::get('/admin', 'web\PageController@admin');
Route::get('/', 'web\PageController@home');

/*
| Blogs routes
*/
Route::get('/blogs', 'web\BlogController@index');
Route::get('/blogs/category/{category}', 'web\BlogController@indexCategory');
Route::get('/blogs/{url_title}', 'web\BlogController@getFromTitle');

/*
| Academies routes
*/
Route::get('/academies', 'web\AcademyController@index');
Route::get('/academies/registration', 'web\AcademyController@registration');
Route::get('/academies/{url_name}', 'web\AcademyController@show');

/*
| Ask Careers routes
*/
Route::get('/ask-careers', 'web\AskCareerController@index');
Route::get('/mentors/{url_name}', 'web\AskCareerController@show');

/*
| Jobs routes
*/
Route::get('/jobs', 'web\JobController@index');
Route::get('/jobs/create', 'web\JobController@create');
Route::get('/jobs/{id}', 'web\JobController@show');

/*
| Student Ambassador routes
*/
Route::get('/student-ambassador', 'web\StudentAmbassadorController@index');

/*
| Login Socialite routes
*/
//Route::get('/socialite-redirect/{provider}', 'web\SocialiteLoginController@redirectToProvider');
//Route::get('/socialite-callback/{provider}', 'web\SocialiteLoginController@handleProviderCallback');


