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
    Route::get('/products/date_sale','Api\apiController@getDateSale');
    Route::get('/products/percent_sale','Api\apiController@getPercentSale');
    Route::get('/products/detail/{id}','Api\apiController@getDetailProduct');
    Route::get('/products/product_attributes','Api\apiController@getProductAttribute');
    Route::post('/products/add','Api\apiController@addProduct');

//    ROUTE PRODUCT ATTRIBUTE
    Route::get('/attribute/all-pro','Api\apiController@getProAttr');
    Route::post('/attribute/addAttr','Api\apiController@postProAttr');
//    Route::post('/attribute/edit/{pro_id}','Api\apiController@editAttr');
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
    Route::delete('/attr/delete/{sku}','Api\apiController@removeAttr');
//    ROUTE PRICE
    Route::get('/prices','Api\apiController@getPrice');
    Route::get('/percent','Api\apiController@getPercent');
    Route::get('/date-sale','Api\apiController@getDateId');
    Route::get('/pro-price','Api\apiController@getProPrice');
    Route::post('/price/add','Api\apiController@addPrice');
    Route::post('/price/edit/{id}','Api\apiController@editPrice');
//    ROUTE DATE
    Route::get('/date','Api\apiController@getDay');
    Route::post('/add_day','Api\apiController@postDay');
    Route::post('/date-edit/{id}','Api\apiController@updateDay');
//    ROUTE SUPPLIER
    Route::get('/suppliers','Api\apiController@getSupplier');
    Route::post('/suppliers/add','Api\apiController@postSupplier');
//    ROUTE ORDER
    Route::get('/orders','Api\apiController@getAllOrder');
    Route::get('/orders/detail/{id}','Api\apiController@getDetailOrder');
    Route::put('/orders/state-status/{id}','Api\apiController@stateStatus');
    Route::get('/orders/to-day','Api\apiController@getOrderToday');
    Route::get('/orders/revenue/month','Api\apiController@getRevenueMonth');
    Route::get('/orders/count-length','Api\apiController@getNumberOrder');
    Route::get('/orders/list-day','Api\apiController@getListDay');
});

Route::group(['prefix'=>'admin/dashboard','middleware' => 'adminLogin'], function(){
    Route::get('/','adminController@getDashboard')->name('getDashboard');
//    Route::get('/users','Api\apiController@user_index');
    Route::view('/{any}', 'admin.admin')->where('any', '.*');
//    Route::group(['prefix','category'], function (){
//
//    });

});
