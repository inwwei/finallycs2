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

Route::get('storage/{any}', 'App\Http\Controllers\StorageController@index')->where('any', '.*');

/**
 * การทำงานที่เกี่ยวกับการเข้าใช้งานระบบ Login, Logout, Info
 */

Route::post('login/register', 'App\Http\Controllers\LoginController@register');
Route::post('login', 'App\Http\Controllers\LoginController@loginOffice');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', 'App\Http\Controllers\LoginController@logoutOffice');
    Route::get('info', 'App\Http\Controllers\LoginController@info');
    Route::resource('attached', 'App\Http\Controllers\AttachedController');
    Route::get('helper/alltag', 'App\Http\Controllers\HelperController@allTag');
    Route::get('Charts', 'App\Http\Controllers\ChartsController@index');
    Route::get('Plants', 'App\Http\Controllers\PlantController@index');
    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::get('user_data', 'App\Http\Controllers\UserController@getUser');
    Route::get('user/{id}', 'App\Http\Controllers\UserController@show');
    Route::get('user_data_all', 'App\Http\Controllers\UserController@user_data_all');
    Route::put('user_data/{id}', 'App\Http\Controllers\UserController@update_profile');
    // Route::get('post_with_company', 'App\Http\Controllers\UserController@getPostWithCompany');
    Route::get('post_with_company', 'App\Http\Controllers\ProductController@getPostWithCompany');


});





// Route::get('partner', 'App\Http\Controllers\Settings\SettingMasterCustomerController@getPartner');
