<?php

use Illuminate\Support\Facades\Route;
Route::resource('ranking', 'App\Http\Controllers\RankingController');
Route::get('WhatToPlant', 'App\Http\Controllers\WhatToPlantController@index');
Route::get('hit', 'App\Http\Controllers\WhatToPlantController@index');
Route::get('best', 'App\Http\Controllers\ProcessController@bestprice');
Route::post('post_company/{id}', 'App\Http\Controllers\CompanyController@post_company');



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

// Route::post('login/register', 'App\Http\Controllers\LoginController@register');
Route::resource('register', 'App\Http\Controllers\RegisterController');
Route::post('login', 'App\Http\Controllers\LoginController@loginOffice');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', 'App\Http\Controllers\LoginController@logoutOffice');
    Route::get('info', 'App\Http\Controllers\LoginController@info');
    Route::resource('attached', 'App\Http\Controllers\AttachedController');
    Route::get('helper/alltag', 'App\Http\Controllers\HelperController@allTag');
    Route::get('Charts', 'App\Http\Controllers\ChartsController@index');
    Route::get('Plants', 'App\Http\Controllers\PlantController@index');
    Route::get('product/show_announce/{id}', 'App\Http\Controllers\ProductController@show_announce');
    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::get('user_data', 'App\Http\Controllers\UserController@getUser');
    Route::get('user_data_all', 'App\Http\Controllers\UserController@user_data_all');
    Route::get('post_with_company', 'App\Http\Controllers\ProductController@getPostWithCompany');
    Route::resource('company', 'App\Http\Controllers\CompanyController');


});





// Route::get('partner', 'App\Http\Controllers\Settings\SettingMasterCustomerController@getPartner');
