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

Route::group([], function () {
    Route::get('/users', ['as' => 'users.list', 'uses' => 'API\UserAPIController@getUsers']);
    Route::get('/users/{id}', ['as' => 'user.info', 'uses' => 'API\UserAPIController@getUser']);
    Route::delete('/users/{id}', ['as' => 'user.delete', 'uses' => 'API\UserAPIController@deleteUser']);
    Route::put('/users/{id}', ['as' => 'user.update', 'uses' => 'API\UserAPIController@updateUser']);
    Route::post('/users', ['as' => 'user.create', 'uses' => 'API\UserAPIController@createUser']);
});