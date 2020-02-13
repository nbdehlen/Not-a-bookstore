<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

// Items
Route::get('items/{item_id}', 'ItemController@show');
Route::post('items/search', 'ItemController@search');

// Cart
Route::get('cart/sum', 'CartController@sum');
Route::get('cart', 'CartController@index');
Route::post('cart', 'CartController@show');
Route::patch('cart/{item_id}', 'CartController@update');
Route::delete('cart/{item_id}', 'CartController@destroy');
Route::delete('cart', 'CartController@clear');
