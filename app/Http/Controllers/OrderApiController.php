<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $hasSearch = false;
        if ($request->has('phrase')) {
            $fieldName = trim($request->input('field'));
            $phrase = trim($request->input('phrase'));

            $dbColumn = $this->getColumnBySynonym($fieldName);
            $hasSearch = empty($dbColumn) === false && empty($phrase) === false;
        }

        $items = [];
        if ($hasSearch) {
            $items = DB::table('order_history')->where($dbColumn, '=', $phrase)->get();
        }

        if (!$hasSearch) {
            $items = DB::table('order_history')->get();
        }

        return response()->json($items);
    }

    private function getColumnBySynonym($synonym)
    {
        $mapping = [
            'client'=> 'client_name',
            'product' => 'product_name',
            'total' => 'total',
            'date' => 'created_at',
        ];

        $col = $mapping[$synonym] ?? '';

        if (!empty($col)) {
            return $mapping[$synonym];
        }

        return false;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
