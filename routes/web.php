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

//Route::get('/items/{item_id}/{amount}', 'ItemController@show');

//Route::get('/items/search', 'ItemController@search');

/*Route::resources([
  //  'items' => 'ItemController',
    'shop' => 'ShopController'
]);*/
