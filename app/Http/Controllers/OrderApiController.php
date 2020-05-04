<?php

namespace App\Http\Controllers;

use App\Features\Filtering\SortParam;
use App\OrderHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderApiController extends Controller
{
    /**
     * @param Request $request
     * @param OrderHistory $orders
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, OrderHistory $orders)
    {
        /**
         * @var Builder $Q
         */
        $Q = $orders->filter($request->all());

        if ($request->input('details')) {
            $cols = Str::of($request->input('details'))
                ->explode(',');
            $cols = $cols->intersect($orders->getFillable());
            $Q->select($cols->all());
        }

        if ($request->has('sort')) {
            $param = $request->input('sort');
            $Q = $Q->customOrderBy(new SortParam($param));
        }

        $items = $Q->get();

        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
