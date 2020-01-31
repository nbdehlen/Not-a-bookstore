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
Route::get('item/{item_id}', 'ItemController@show');

// Cart
Route::get('item/{item_id}/{amount}', 'CartController@show');
Route::patch('cart/{item_id}/{amount}', 'CartController@update');
Route::delete('cart/{item_id}', 'CartController@destroy');
