<?php

namespace App\Http\Controllers;

use App\OrderHistory;
use Illuminate\Http\Request;

class OrderHistoryFeatureController extends Controller
{
    /**
     * @param Request $request
     * @param OrderHistory $orders
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request, OrderHistory $orders)
    {
        if ($request->has('phrase')) {
            $phrase = trim($request->input('phrase'));

            $items = $orders->searchByAll($phrase)->get();

            return response()->json($items);
        }

        $errors = [
            'error' => __('Error! Empty search phrase'),
        ];

        return response()->json($errors);
    }

    public function showChart()
    {
        return view('orders.chart');
    }
}
