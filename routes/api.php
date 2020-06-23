<?php

use Illuminate\Http\Request;
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
Route::group(['prefix' => 'v1/user'],function () {
    Route::post('/auth/login', 'v1\User\Auth\LoginController@index');
    Route::post('/auth/register', 'v1\User\Auth\RegisterController@index');
    Route::post('/auth/logout', 'v1\User\Auth\LogoutController@index');
    Route::post('/auth/forgot-password/', 'v1\User\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('/auth/forgot-password/{token}/{email}', 'v1\User\Auth\ForgotPasswordController@checkTokenReset');
    Route::post('/auth/new-password', 'v1\User\Auth\ForgotPasswordController@newPassword');
});

Route::group(['prefix' => 'v1/user', 'middleware' => ['auth:customer,super_admin']],function () {

    Route::get('/auth/check-token', 'v1\User\Auth\LoginController@checkToken');
    Route::get('/activity-log', 'v1\ActivityController@index');
});


//======================================Customer=================================================

Route::group(['prefix' => 'v1/user', 'middleware' => ['auth:customer']],function () {

    Route::post('/auth/reset-password', 'v1\User\Auth\ResetPasswordController@update');

    /*
    | Device Routes
    */
    Route::resource('devices','v1\User\DeviceController');

    
    /*
    | Campaign Routes
    */
    Route::post('campaigns/slots', 'v1\User\CampaignController@available_slots');
    Route::resource('campaigns','v1\User\CampaignController');
    //** for hard deleting campaign use: initial_Url/campaigns?hard=true
    //** can filter campaigns index by status: initial_Url/admin/campaigns?status=submission

    /*
    | Content Master Routes
    */
    Route::resource('content-masters','v1\User\ContentMasterController');


    /*
    | Campaign File Routes
    */
    Route::resource('contents','v1\User\ContentController');

    /*
    | User Routes
    */
    Route::post('users', 'v1\User\UserController@update');

    /*
    | Location Routes
    */
    Route::get('locations/list','v1\User\LocationController@list');
    Route::resource('locations','v1\User\LocationController')->except(['store','update','destroy']);

    /*
    | Playlist Routes
    */
    Route::resource('playlists','v1\User\PlaylistController');

});





//======================================admin=================================================

Route::group(['prefix' => 'v1/admin', 'middleware' => ['auth:super_admin']],function () {
    /*
    | Campaign Routes
    */
    Route::resource('campaigns','v1\Admin\CampaignController');
    //** for hard deleting campaign use: initial_Url/admin/campaigns?hard=true
    //** can filter campaigns index by status, and trashed: initial_Url/admin/campaigns?trashed=true&status=submission

    /*
    | Guaranteed Routes
    */
    Route::resource('guaranteeds','v1\Admin\GuaranteedController');
    Route::post('guaranteeds/slots', 'v1\Admin\GuaranteedController@check_available_guaranteed');
    /*
    | Playlist Routes
    */
    Route::resource('playlists','v1\Admin\PlaylistController');

    /*
    | Campaign File Routes
    */
    Route::resource('contents','v1\Admin\ContentController');

    /*
    | Content Master Routes
    */
    Route::resource('content-masters','v1\Admin\ContentMasterController');

    /*
    | Devices Routes
    */
    Route::get('devices/list','v1\Admin\DeviceController@list');
    Route::get('device/log','v1\Device\LogController@all');
    Route::resource('devices','v1\Admin\DeviceController');

    /*
    | Boxes Routes
    */
    Route::get('boxes/list','v1\Admin\BoxController@list');
    Route::resource('boxes','v1\Admin\BoxController');

    /*
    | Cars Routes
    */
    Route::get('cars/list','v1\Admin\CarController@list');
    Route::resource('cars','v1\Admin\CarController');

    /*
    | Drivers Routes
    */
    Route::get('drivers/list','v1\Admin\DriverController@list');
    Route::resource('drivers','v1\Admin\DriverController');

    /*
    | Device Lines
    */
    Route::get('device-lines/create/{device_id}','v1\Admin\DeviceLineController@create');
    Route::resource('device-lines','v1\Admin\DeviceLineController');

    /*
    | Location Routes
    */
    Route::get('locations/list','v1\Admin\LocationController@list');
    Route::resource('locations','v1\Admin\LocationController');

    /*
    | Layout Routes
    */
    Route::get('layouts/list','v1\Admin\LayoutController@list');
    Route::resource('layouts','v1\Admin\LayoutController');

    Route::resource('layout-boxes','v1\Admin\LayoutBoxController');
    
    Route::resource('layout-sequences','v1\Admin\LayoutSequenceController');

    /*
    | Merchant Routes
    */
    Route::get('merchants/list','v1\Admin\MerchantController@list');
    Route::resource('merchants','v1\Admin\MerchantController');

    /*
    | SlotSummary Routes
    */
    Route::resource('slot-summaries','v1\Admin\SlotSummaryController');

    /*
    | Widget Routes
    */
    Route::get('widgets/list','v1\Admin\WidgetController@list');
    Route::resource('widgets','v1\Admin\WidgetController');

});











//======================================Admin=================================================

Route::group(['prefix' => 'v1/admin', 'middleware' => []],function () {
    Route::resource('/posts','v1\Admin\PostController');
    Route::get('/categories/list','v1\Admin\CategoryController@list');
    Route::resource('/categories','v1\Admin\CategoryController');
    Route::post('/medias','v1\Admin\MediaController@store');
});

