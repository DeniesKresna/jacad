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
Route::group(['prefix' => 'v1/user', 'middleware' => ['auth:customer']], function () {
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
    Route::post('/update/{id}', 'v1\Admin\JobController@update');

    //ACADEMY PERIODS
    Route::put('/academy-periods/activate/{id}', 'v1\Admin\AcademyPeriodController@activate');
    Route::get('/academy-periods/customers', 'v1\Admin\AcademyPeriodController@getCustomers');
    Route::get('/academy-periods/customers/{id}', 'v1\Admin\AcademyPeriodController@destroyCustomer');
    /*Route::group(['prefix' => 'academy-periods/customers'], function () {
        Route::get('/', 'v1\Admin\AcademyPeriodController@getCustomers');
        Route::delete('/{id}', 'v1\Admin\AcademyPeriodController@destroyCustomer');
    });*/
    
    //JOBS
    Route::post('/jobs/update/{id}', 'v1\Admin\JobController@update');
    Route::put('/jobs/verify/{id}', 'v1\Admin\JobController@verify');
    Route::group(['prefix' => 'job-applicants'], function () {
        Route::get('/', 'v1\Admin\JobController@getApplicants');
    });
    
    //MEDIAS
    Route::post('/medias','v1\Admin\MediaController@store');

    //RESOURCE - UPDATE
    Route::post('/mentors/update/{id}', 'v1\Admin\MentorController@update');
    Route::post('/blogs/update/{id}', 'v1\Admin\BlogController@update');
    Route::post('/academies/update/{id}', 'v1\Admin\AcademyController@update');
    Route::post('/ask-careers/update/{id}', 'v1\Admin\AskCareerController@update');
    Route::post('/mentoring/update/{id}', 'v1\Admin\MentoringController@update');

    //RESOURCES
    Route::resource('/users', 'v1\Admin\UserController');
    Route::resource('/mentors', 'v1\Admin\MentorController');
    Route::resource('/openings', 'v1\Admin\OpeningController');
    Route::resource('/tags','v1\Admin\TagController');
    Route::resource('/blogs','v1\Admin\BlogController');
    Route::resource('/academies', 'v1\Admin\AcademyController');
    Route::resource('/academy-periods', 'v1\Admin\AcademyPeriodController');
    Route::resource('/ask-careers', 'v1\Admin\AskCareerController');
    Route::resource('/mentoring', 'v1\Admin\MentoringController');
    Route::resource('/jobs', 'v1\Admin\JobController');
    Route::resource('/student-ambassadors', 'v1\Admin\StudentAmbassadorController');
    Route::resource('/payments', 'v1\Admin\PaymentController');
});

Route::group(['prefix' => 'v1/user', 'middleware' => []],function () {
    Route::get('/auth', 'v1\User\UserController@auth');
    
    //REGISTER, LOGIN & LOGOUT
    Route::post('/auth/register', 'v1\User\RegisterController@store');
    Route::get('/auth/register-token/{token}', 'v1\User\RegisterController@checkToken');
    Route::post('/auth/login', 'v1\User\LoginController@index');
    Route::get('/auth/logout', 'v1\User\LogoutController@index');

    //COMPANY NAME
    Route::get('/companies/name/{name}', 'v1\User\CompanyController@showByName');
    
    //ACADEMY REGISTRATION
    Route::post('/academy-registrations', 'v1\User\AcademyRegistrationController@store');
    Route::post('/academy-registrations/payment-'.env('MIDTRANS_PAYMENT_SECRET_URL'), 'v1\User\AcademyRegistrationController@successPayment');
    
    Route::post('/mentoring', 'v1\User\MentoringController@store');
    Route::post('/jobs', 'v1\User\JobController@store');
    Route::post('/job-applications', 'v1\User\JobApplicationController@store');
    Route::post('/student-ambassadors', 'v1\User\StudentAmbassadorController@store');
});


