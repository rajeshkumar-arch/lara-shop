<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', ['as' => 'products.list', 'uses' => 'API\ProductAPIController@getProducts']);
Route::get('/products/{product_slug}', ['as' => 'product.show', 'uses' => 'API\ProductAPIController@getProduct']);
Route::get('/cart', ['as' => 'cart.items', 'uses' => 'API\CartAPIController@getCartItems']);


// Registered, activated, and is admin routes.
Route::group([], function () {
    Route::get('/users', ['as' => 'users.list', 'uses' => 'API\UserAPIController@getUsers']);
    Route::get('/users/{id}', ['as' => 'user.info', 'uses' => 'API\UserAPIController@getUser']);
});