<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bestprice()
    {
        $plants = Plant::get();
        $name = [];
        foreach ($plants as $index => $plant) {
            $plant['name'];
            $query_part = Product::where('name', $plant['name'])->first();
            $query_present = Product::where('name', $plant['name'])->orderBy('price_per_kk', 'desc')->first();

            $result = [
                'query' => $query_present,
            ];

            if (strlen($result['query'])>2) {
                array_push($name, $result);
            }
        }

        return response()->success($name, [], '0', 200);
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
