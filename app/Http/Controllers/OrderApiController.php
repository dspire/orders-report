<?php

namespace App\Http\Controllers;

use App\Features\Filtering\DetailsParam;
use App\Features\Filtering\SortParam;
use App\OrderHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

        if ($request->has('details')) {
            $details = new DetailsParam($request->input('details'));
            $details->setAcceptable($orders->getFillable());
            $Q->select($details->toArray());
        }

        if ($request->has('sort')) {
            $sortParam = new SortParam($request->input('sort'));
            $Q->orderByRaw($sortParam->toSqlString());
        }

        if ($request->has('offset')) {
            $param = (int)$request->input('offset');
            $Q = $Q->skip($param);
        }

        if ($request->has('limit')) {
            $limitParam = (int)$request->input('limit');
        }

        $items = $Q->take($limitParam ?? 20)->get();

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
