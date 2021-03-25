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
*/
Route::get('/', 'App\Http\Controllers\WebController@loadPage');

Route::get('storage/{any}', 'App\Http\Controllers\StorageController@index')->where('any', '.*');

Route::get('datatable', 'App\Http\Controllers\DataTableController@index');

Route::get('demo', 'App\Http\Controllers\DataTableController@demo');

/**
 * ถ้าจะทดสอบอะไร ให้ไปสร้าง Route ไป TestController
 */
Route::get('/test', function () {
    return view('Add');
});
