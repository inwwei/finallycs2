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

    Route::resource('customers', 'App\Http\Controllers\CustomerController');
    Route::get('customercontacts/{id}', 'App\Http\Controllers\CustomerContactController@index');
    Route::post('customercontacts/{id}', 'App\Http\Controllers\CustomerContactController@store');
    Route::get('customercontacts/{id}/{request}', 'App\Http\Controllers\CustomerContactController@show');
    Route::match(['put', 'patch'], 'customercontacts/{id}/{customer_contact_id}', 'App\Http\Controllers\CustomerContactController@update');
    Route::delete('customercontacts/{id}/{customer_contact_id}', 'App\Http\Controllers\CustomerContactController@destroy');

    Route::resource('datatable', 'App\Http\Controllers\DataTableController');

    Route::resource('user', 'App\Http\Controllers\UserController');

    Route::get('usercontact/{user_id}', 'App\Http\Controllers\UserContactController@index');
    Route::post('usercontact/{user_id}', 'App\Http\Controllers\UserContactController@store');
    Route::get('usercontact/{user_id}/{user_contact_id}', 'App\Http\Controllers\UserContactController@show');
    Route::match(['put', 'patch'], 'usercontact/{user_id}/{user_contact_id}', 'App\Http\Controllers\UserContactController@update');
    Route::delete('usercontact/{user_id}/{user_contact_id}', 'App\Http\Controllers\UserContactController@destroy');

    Route::get('productorder_detail/{id}', 'App\Http\Controllers\ProductOrderDetailController@index');
    Route::post('productorder_detail/{id}', 'App\Http\Controllers\ProductOrderDetailController@store');
    Route::get('productorder_detail/{id}/{request}', 'App\Http\Controllers\ProductOrderDetailController@show');
    Route::match(['put', 'patch'], 'productorder_detail/{id}/{productorder_detail_id}', 'App\Http\Controllers\ProductOrderDetailController@update');
    Route::delete('productorder_detail/{id}/{productorder_detail_id}', 'App\Http\Controllers\ProductOrderDetailController@destroy');

    // Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::get('usercontact/{user_id}/{user_contact_id}', 'App\Http\Controllers\UserContactController@show');
    Route::resource('productorder', 'App\Http\Controllers\ProductOrderController');
    Route::resource('saleproduct', 'App\Http\Controllers\SaleProductController');
    Route::get('saleproductdetail/{id}', 'App\Http\Controllers\SaleProductDetailController@index');
    Route::post('saleproductdetail/{id}', 'App\Http\Controllers\SaleProductDetailController@store');
    Route::get('saleproductdetail/{id}/{request}', 'App\Http\Controllers\SaleProductDetailController@show');
    Route::match(['put', 'patch'], 'saleproductdetail/{id}/{sell_product_id}', 'App\Http\Controllers\SaleProductDetailController@update');
    Route::delete('saleproductdetail/{id}/{sell_product_id}', 'App\Http\Controllers\SaleProductDetailController@destroy');

    /**
     * ตั้งค่า
     */
    Route::resource('setting/master/product', 'App\Http\Controllers\Settings\SettingMasterProductController');
    Route::resource('setting/master/customer', 'App\Http\Controllers\Settings\SettingMasterCustomerController');
    Route::resource('setting/master/user', 'App\Http\Controllers\Settings\SettingMasterUserController');
    Route::resource('setting/master/contact', 'App\Http\Controllers\Settings\SettingMasterContactController');

    // ดึงพาทเนอร์
    Route::get('partner', 'App\Http\Controllers\Settings\SettingMasterCustomerController@getPartner');
    Route::get('getSetting', 'App\Http\Controllers\ProductController@getSetting');
    Route::get('getProduct/{id}', 'App\Http\Controllers\Settings\SettingMasterProductController@getProduct');

    /**
     * ถ้าจะทดสอบอะไร ให้ไปสร้าง Route ไป TestController
     */
    Route::get('test/jim', 'App\Http\Controllers\TestController@testJim');
    Route::get('test/chart', 'App\Http\Controllers\TestController@testChart');
    Route::resource('setting/generate/code', 'App\Http\Controllers\Settings\SettingGenerateCodeController');
    Route::resource('setting/master/user', 'App\Http\Controllers\Settings\SettingMasterUserController');
    Route::resource('setting/master/product', 'App\Http\Controllers\Settings\SettingMasterProductController');
    Route::resource('setting/basic/company', 'App\Http\Controllers\Settings\SettingBasicCompanyController');
    Route::resource('setting/basic/branch', 'App\Http\Controllers\Settings\SettingBasicBranchController');

    Route::get('productorder_detail', 'App\Http\Controllers\ProductOrderDetailController@getReceivs');

    Route::get('getSettingProduct', 'App\Http\Controllers\Settings\SettingMasterProductController@getSetting');
    Route::get('getUser', 'App\Http\Controllers\UserController@getUser');
    Route::get('partner', 'App\Http\Controllers\CustomerController@getPartner');
    Route::get('getLoginUser', 'App\Http\Controllers\UserController@getLoginUser');
    Route::resource('product', 'App\Http\Controllers\ProductController');
    Route::post('product/receive/{id}', 'App\Http\Controllers\ReceiveController@getOrderDetail');
    // Route::get('product/receive/', 'App\Http\Controllers\ReceiveController@getOrderDetailSucces');
    Route::post('product/received/{data}', 'App\Http\Controllers\ReceiveController@store');

    // Route::get('product/{product_id}', 'App\Http\Controllers\ProductController@show');
Route::post('product/sale/{branch_id}', 'App\Http\Controllers\ProductController@getProductWithBranch');
Route::post('product/receive/{id}', 'App\Http\Controllers\ReceiveController@getOrderDetail');
Route::post('product/received/', 'App\Http\Controllers\ReceiveController@store');

});
Route::get('Charts', 'App\Http\Controllers\ChartsController@index');


// Route::get('partner', 'App\Http\Controllers\Settings\SettingMasterCustomerController@getPartner');
