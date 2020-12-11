<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
| Initial URL = domainName/public/api/auth
*/


/*
|---------------------------------------------------------------------------
| ==========================================================================
| ========================= API Version 1 Routes ===========================
| ==========================================================================
|---------------------------------------------------------------------------
| Initial URL = domainName/public/api/v1/
*/
Route::group(['prefix' => 'v1/user'], function () {
    Route::post('/auth/login', 'v1\User\Auth\LoginController@index');
    Route::post('/auth/register', 'v1\User\Auth\RegisterController@index');
    Route::post('/auth/logout', 'v1\User\Auth\LogoutController@index');
    Route::post('/auth/forgot-password/', 'v1\User\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('/auth/forgot-password/{token}/{email}', 'v1\User\Auth\ForgotPasswordController@checkTokenReset');
    Route::post('/auth/new-password', 'v1\User\Auth\ForgotPasswordController@newPassword');
});

Route::group(['prefix' => 'v1/user', 'middleware' => ['auth:customer,super_admin']],function () {

    Route::get('/auth/check-token', 'v1\User\Auth\LoginController@checkToken');
});


//======================================Customer=================================================

Route::group(['prefix' => 'v1/user', 'middleware' => ['auth:customer']],function () {

    Route::post('/auth/reset-password', 'v1\User\Auth\ResetPasswordController@update');

    /*
    | User Routes
    */
    Route::post('users', 'v1\User\UserController@update');

    /*
    | Location Routes
    */
    Route::get('locations/list','v1\User\LocationController@list');
    Route::resource('locations','v1\User\LocationController')->except(['store','update','destroy']);
});

Route::get('test','v1\TestController@adi');



//======================================Admin=================================================

Route::group(['prefix' => 'v1/admin', 'middleware' => ['auth:super_admin']],function () {

});


    









//======================================no Middleware=================================================

Route::group(['prefix' => 'v1/admin', 'middleware' => []], function () {
    //LIST
    Route::get('/mentors/list', 'v1\Admin\MentorController@list');
    Route::get('/categories/list','v1\Admin\CategoryController@list');
    Route::get('/tags/list','v1\Admin\TagController@list');
    Route::get('/sectors/list', 'v1\Admin\SectorController@list');
    Route::get('/locations/list', 'v1\Admin\LocationController@list');
    Route::get('/academies/list', 'v1\Admin\AcademyController@list');
    
    //MEDIAS
    Route::post('/medias','v1\Admin\MediaController@store');

    //RESOURCE - GET
    Route::get('/academy-periods/customers', 'v1\Admin\AcademyPeriodController@getPeriodCustomers');

    //RESOURCE - UPDATE
    Route::post('/mentors/update/{id}', 'v1\Admin\MentorController@update');
    Route::post('/blogs/update/{id}', 'v1\Admin\BlogController@update');
    Route::post('/academies/update/{id}', 'v1\Admin\AcademyController@update');
    Route::post('/ask-careers/update/{id}', 'v1\Admin\AskCareerController@update');
    Route::post('/mentoring/update/{id}', 'v1\Admin\MentoringController@update');
    Route::post('/jobs/update/{id}', 'v1\Admin\JobController@update');

    //RESOURCES
    Route::resource('/users', 'v1\Admin\UserController');
    Route::resource('/mentors', 'v1\Admin\MentorController');
    Route::resource('/openings', 'v1\Admin\OpeningController');
    Route::resource('/tags','v1\Admin\TagController');
    Route::resource('/blogs','v1\Admin\BlogController');
    Route::resource('/academies', 'v1\Admin\AcademyController');
    Route::resource('/academy-periods', 'v1\Admin\AcademyPeriodController');
    Route::resource('/academy-periods/customer', 'UserController');
    Route::resource('/ask-careers', 'v1\Admin\AskCareerController');
    Route::resource('/mentoring', 'v1\Admin\MentoringController');
    Route::resource('/jobs', 'v1\Admin\JobController');
    Route::resource('/job-applications', 'v1\Admin\JobApplicationController');
    Route::resource('/student-ambassadors', 'v1\Admin\StudentAmbassadorController');

    //Route::post('/adi/test','v1\TestController@adi');
});

Route::group(['prefix' => 'v1/user', 'middleware' => []],function () {
    Route::get('/auth', 'v1\User\UserController@auth');
    Route::get('/companies/name/{name}', 'v1\User\CompanyController@showByName');
    
    Route::post('/academy-registrations', 'v1\User\AcademyRegistrationController@store');
    Route::post('/mentoring', 'v1\User\MentoringController@store');
    Route::post('/jobs', 'v1\User\JobController@store');
    Route::post('/job-applications', 'v1\User\JobApplicationController@store');
    Route::post('/student-ambassadors', 'v1\User\StudentAmbassadorController@store');
});

/* API LOGIN & REGISTER */
Route::group(['prefix' => 'v1', 'middleware' => []], function() {
    Route::post('/register', 'v1\RegisterController@store');
    Route::get('/register-token/{token}', 'v1\RegisterController@check_token');
    
    Route::post('/login', 'v1\LoginController@index');
});
/* API LOGIN & REGISTER */



