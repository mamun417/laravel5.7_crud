<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function (){

    Route::name('admin.')->group(function () {

        Route::get('/', 'Admin\AdminController@index')->name('dashboard');

        /*brand*/
        Route::get('brands/reset', 'Admin\BrandsController@reset')->name('brands.reset');
        Route::get('brands/{brand}/{old}/change-status', 'Admin\BrandsController@changeStatus')->name('brands.change-status');
        Route::resource('brands', 'Admin\BrandsController');

        /*category*/
        Route::get('categories/{category}/{old}/change-status', 'Admin\CategoriesController@changeStatus')->name('categories.change-status');
        Route::get('categories/reset', 'Admin\CategoriesController@reset')->name('categories.reset');
        Route::resource('categories', 'Admin\CategoriesController');
    });

});
