<?php

use Illuminate\Support\Facades\Route;
Route::get('product/receive', 'App\Http\Controllers\ReceiveController@getOrderDetailSucces');

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
Route::post('login', 'App\Http\Controllers\LoginController@loginOffice');
Route::post('setting/device/usepin', 'App\Http\Controllers\Settings\SettingDeviceController@usepin');
Route::post('setting/device/checkpin', 'App\Http\Controllers\Settings\SettingDeviceController@checkpin'); // จะไม่โดนคุมด้วยสิทธิ์เพราะต้องตรวจก่อนใช้ระบบ
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('setting/device', 'App\Http\Controllers\Settings\SettingDeviceController');
    Route::post('logout', 'App\Http\Controllers\LoginController@logoutOffice');
    Route::get('info', 'App\Http\Controllers\LoginController@info');
    Route::resource('attached', 'App\Http\Controllers\AttachedController');
    Route::get('helper/alltag', 'App\Http\Controllers\HelperController@allTag');
    Route::get('Charts', 'App\Http\Controllers\ChartsController@index');
    Route::get('Plants', 'App\Http\Controllers\PlantController@index');
    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::get('user_data', 'App\Http\Controllers\UserController@getUser');
    Route::put('user_data/{id}', 'App\Http\Controllers\UserController@update_profile');
    // Route::get('post_with_company', 'App\Http\Controllers\UserController@getPostWithCompany');


});

Route::get('post_with_company', 'App\Http\Controllers\ProductController@getPostWithCompany');




// Route::get('partner', 'App\Http\Controllers\Settings\SettingMasterCustomerController@getPartner');
