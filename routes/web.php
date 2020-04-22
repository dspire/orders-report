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

Route::get('api/clients', 'ClientController@index');

Route::resource('orders', 'OrderApiController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::get('chart/orders', 'OrderHistoryFeatureController@showChart');
Route::get('search/orders', 'OrderHistoryFeatureController@search');


# Sandbox for collections
Route::get('play/group-master', function () {
    $tbl = \Illuminate\Support\Facades\DB::table('order_history');

    $items = $tbl->orderBy('ordered_at', 'desc')->take(12)->get();

    // values.groupBy(column).eachGroup().sum(total)
    $grouped = $items->groupBy('ordered_at');
    $multiplied = $grouped->map(function ($group, $key) {
        $sum = 0;
        foreach ($group as $chunk) {
            $sum += floatval($chunk->total);
        }
        if ($sum == false) {
            throw new Exception('!wat');
        }
        return $sum;
    });



    return $multiplied;
});

Route::get('play/reduce-master', function () {
    // todo: achieve the same result with reduce method as route: play/group-master
});
