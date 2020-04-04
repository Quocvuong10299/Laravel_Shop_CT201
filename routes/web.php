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

Route::get('/','HomeController@index')->name('home');
Route::get('/chi-tiet-san-pham/{id}','HomeController@productDetail')->name('productDetail');
//route get ajax
Route::get('/select-color','HomeController@selectColor');
Route::get('/select-size','HomeController@selectSize');
//route get products men
Route::get('/ao-so-mi-nam','PageMenController@pageShirtMen')->name('pageShirtMen');
Route::get('/ao-so-mi-thun-nam','PageMenController@pageTshirtMen')->name('pageTshirtMen');
Route::get('/quan-jean-nam','PageMenController@pageJeanMen')->name('pageJeanMen');
Route::get('/quan-tay-nam','PageMenController@pageTrousersMen')->name('pageTrousersMen');
// route get product women
Route::get('/ao-so-mi-nu','PageWomenController@pageShirtWomen')->name('pageShirtWomen');
Route::get('/ao-so-mi-thun-nu','PageWomenController@pageTshirtWomen')->name('pageTshirtWomen');
Route::get('/quan-jean-nu','PageWomenController@pageJeanWomen')->name('pageJeanWomen');
Route::get('/dam-thun-nu','PageWomenController@pageDressWomen')->name('pageDressWomen');