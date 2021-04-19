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
        $plants = Plant::get();
        $name = [];
        foreach ($plants as $index => $plant) {
            $plant['name'];
            // $find = Product::where('name', '=', $plant['name'])->firstOrFail();
            // if ($find) {
                $query_part = Product::where('name', $plant['name'])->where('status','ปกติ')->get();
                $query_count = Product::where('name', $plant['name'])->where('status','ปกติ')->count();
            // }
            $result = [
                'name' => $plant['name'],
                'sum' => $query_count,
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