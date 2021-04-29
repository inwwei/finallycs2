<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class WhatToPlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = 0;
        $plants = Plant::get();
        $name = [];

        foreach ($plants as $index => $plant) {
            $amount_sum = [];
            $plant['name'];
            // $find = Product::where('name', '=', $plant['name'])->firstOrFail();
            // if ($find) {
            $query_part = Product::where('name', $plant['name'])->where('status', 'ปกติ')->get();

            foreach ($query_part as $key => $data) {

                if ($data->unit == 'กรัม') {
                    $sum = $data->amount / 1000;
                    array_push($amount_sum, $sum);
                } elseif ($data->unit == 'ขีด') {
                    $sum = $data->amount / 10;
                    array_push($amount_sum, $sum);
                } elseif ($data->unit == 'กิโลกรัม') {
                    $sum = $data->amount * 1000;
                    array_push($amount_sum, $sum);
                }
                $all_sum = array_sum($amount_sum);
            }
            $query_count = Product::where('name', $plant['name'])->where('status', 'ปกติ')->count();

            $result = [
                'name' => $plant['name'],
                'sum' => $query_count,
                'amount' => $all_sum,
            ];
            array_push($name, $result);
        }
        if (!$query_part) {
            return response()->error(['ไม่สามารถแก้ไขข้อมูลได้'], '40');
        } else {
            return response()->success($name, [], '0', 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
