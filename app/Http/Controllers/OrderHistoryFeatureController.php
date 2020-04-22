<?php

namespace App\Http\Controllers;

use App\OrderHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            return $items;
        }

        $errors = [
            'error' => __('Error! Empty search phrase'),
        ];

        return response()->json($errors);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChart()
    {
        // fetch last 7 day orders
        $latestOrders = DB::table('order_history')
            ->select(DB::raw('ordered_at, sum(total) as total_per_day'))
            ->groupBy('ordered_at')
            ->orderByRaw('STR_TO_DATE(ordered_at,\'%m/%d/%Y\') DESC')
            ->take(Carbon::DAYS_PER_WEEK)
            ->get();

        dd($latestOrders);

        return view('orders.chart');
    }
}
