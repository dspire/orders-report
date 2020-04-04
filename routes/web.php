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

Route::get('/', function () {
    $emails = (object)[
        'cc' => 'alexander@webscribble.com',
        'bcc' => 'nick@webscribble.com',
    ];
    //HTML::mailto($email, 'title', $attributes);

    $emailUrl = "mailto:" . $emails->cc . "?bcc=" . $emails->bcc;

    return view('welcome', [
        'emailUrl' => $emailUrl,
        'emailTitle' => 'Email this report'
    ]);
});
