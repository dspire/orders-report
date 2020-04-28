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
        $records = DB::table('order_history')
            ->select('ordered_at', 'total')
            ->orderBy('ordered_at', 'desc')
            ->take(9)
            ->get();

        $grouped = $records->reduce(function ($carry, $item) {
            $sum = $carry[$item->ordered_at] ?? 0;
            $carry[$item->ordered_at] = $sum + floatval($item->total);

            return $carry;
        }, []);

        return view('orders.chart', [
            'labels' => array_keys($grouped),
            'dataset' => array_values($grouped),
        ]);
    }
}
