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
Route::get('/cart','HomeController@showCart')->name('showCart');
Route::get('/checkouts','HomeController@checkOuts')->name('checkOuts');
Route::post('/checkouts','HomeController@postCheckOuts')->name('postCheckOuts');
Route::get('/san-pham/{id}','HomeController@productDetail')->name('productDetail');
Route::get('/product/comment/{id}','HomeController@getComment')->name('getComment');
Route::post('/san-pham/{id}','HomeController@postComment')->name('postComment');
//route get ajax
Route::get('/select-color','HomeController@selectColor');
Route::get('/select-size','HomeController@selectSize')->name('changeSize');
Route::get('/search','HomeController@searchIndex');
Route::get('/supplier','PagesController@selectSupplier');
Route::get('/sort-price','PagesController@selectFollow');
Route::get('/show-product-gender/{id_gender}','PagesController@showProducFollowGender');
//Route::get('/search/action','HomeController@searchAction');

Route::group(['prefix'=>'collections'], function (){
    Route::get('/{gender}/{slug}','PagesController@pageShowAllProduct')->name('pageShowAllProduct');
    Route::get('/{gender}','PagesController@pageProductGender')->name('pageProductGender');
//    Route::get('/{slug_name}','PagesController@pageShowDiscount')->name('pageShowDiscount');
});
Route::group(['prefix'=>'more'], function (){
   Route::get('/contact','moreController@contactUS')->name('contactUS');
});

Route::group(['prefix'=>'account'], function(){
   Route::get('/register','accountController@getRegister')->name('getregister');
   Route::post('/register','accountController@postRegister')->name('postregister');
   Route::get('/login','accountController@getLogin')->name('getlogin');
   Route::post('/login','accountController@postLogin')->name('postlogin');
   Route::get('/logout','accountController@getLogout')->name('getlogout');
});

//admin auth

Route::get('/admin','adminController@getAdminLogin')->name('getAdminLogin');
Route::post('/admin','adminController@postAdminLogin')->name('postAdminLogin');

//api admin
Route::group(['prefix'=>'api','middleware' => 'adminLogin'], function(){
//    ROUTE USERS
    Route::get('/users','Api\apiController@getUser');
    Route::get('/users/to-day','Api\apiController@getUserToDay');
    Route::get('/users/logout','Api\apiController@logOutAdmin');
    Route::delete('users/{id}', 'Api\apiController@removeUser');
//    ROUTE CATEGORY
    Route::get('/category','Api\apiController@getCategory');
    Route::post('/category/edit/{id}','Api\apiController@editCategory');
    Route::post('/category/add','Api\apiController@addCategory');
//    ROUTE PRODUCTS
    Route::get('/products','Api\apiController@getProduct');
//    ROUTE COMMENTS
    Route::get('/comments','Api\apiController@getComment');
    Route::delete('comments/{id}', 'Api\apiController@removeComment');
//    ROUTE SLIDE
    Route::get('/slides','Api\apiController@getSlide');
    Route::post('/slides/edit/{id}','Api\apiController@editSlides');
    Route::post('/slides/add','Api\apiController@addSlides');
//    ROUTE ATTRIBUTE
    Route::get('/colors','Api\apiController@getColor');
    Route::post('/colors/add','Api\apiController@addColor');
    Route::get('/sizes','Api\apiController@getSize');
    Route::post('/sizes/add','Api\apiController@addSize');
//    ROUTE SUPPLIER
    Route::get('/suppliers','Api\apiController@getSupplier');
    Route::post('/suppliers/add','Api\apiController@postSupplier');
//    ROUTE ORDER
    Route::get('/orders/to-day','Api\apiController@getOrderToday');
});

Route::group(['prefix'=>'admin/dashboard','middleware' => 'adminLogin'], function(){
    Route::get('/','adminController@getDashboard')->name('getDashboard');
//    Route::get('/users','Api\apiController@user_index');
    Route::view('/{any}', 'admin.admin')->where('any', '.*');
//    Route::group(['prefix','category'], function (){
//
//    });

});
