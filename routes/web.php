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
Route::get('/admin', 'PageController@admin');
Route::get('/', 'PageController@home');
Route::get('/student-ambassador', 'PageController@studentAmbassador');

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
Route::get('/academies/{url_name}', 'web\AcademyController@show');

/*
| Ask Careers routes
*/
Route::get('/ask-careers', 'web\AskCareerController@index');
Route::get('/mentors/{url_name}', 'web\AskCareerController@show');

/*
| Jobs routes
*/
/*Route::get('job/opening', function() {
    return view('pages.job.opening');
});*/
Route::get('/jobs', 'web\JobController@index');
Route::get('/jobs/create', 'web\JobController@create');
Route::get('/jobs/{id}', 'web\JobController@show');

/*
| Login Socialite routes
*/
Route::get('/socialite-redirect/{provider}', 'web\SocialiteLoginController@redirectToProvider');
Route::get('/socialite-callback/{provider}', 'web\SocialiteLoginController@handleProviderCallback');

/*
| Login - Logout routes
*/
Route::post('/login', 'web\LoginController@index');
Route::get('/logout', 'web\LogoutController@index');


