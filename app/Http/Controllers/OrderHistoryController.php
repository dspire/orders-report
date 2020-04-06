<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    // split into OrderPageController, OrderController
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $emails = (object)[
            'cc' => 'alexander@webscribble.com',
            'bcc' => 'nick@webscribble.com',
        ];

        $emailUrl = "mailto:" . $emails->cc . "?bcc=" . $emails->bcc;

        return view('welcome', [
            'emailUrl' => $emailUrl,
            'emailTitle' => 'Email this report'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
