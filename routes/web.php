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

Route::get('/', 'OrderHistoryController@index');

Route::get('colors', function () {
    return ['Violet', 'Mint', 'Purple'];
});


Route::get('api/orders', 'OrderHistoryController@getItems');

Route::get('api/clients', 'ClientController@index');
