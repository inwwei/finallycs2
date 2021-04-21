<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $first_date = $this->checkdate();
        $end_date = Carbon::now();

        $plants = Plant::get();
        $name = [];
        foreach ($plants as $index => $plant) {
            $plant['name'];
            $query_part = Product::where('name', $plant['name'])->where('created_at', '>', $first_date)->first();
            $query_present = Product::where('name', $plant['name'])->where('created_at', '<', $end_date)->orderBy('created_at', 'desc')->first();
            $sum = 0;

            // if ($query_present->price_per_kk && $query_part->price_per_kk) {
            //     $sum = ($query_present->price_per_kk - $query_part->price_per_kk) / $query_part->price_per_kk;
            // } else {
            //     $sum = 0;
            // }

            $result = [
                'name' => $query_part,
                'sum' => $sum,
            ];
            if (strlen($result['name']) > 2) {
                array_push($name, $result);
            }
        }

        return response()->success($name, [], '0', 200);

    }

    public function checkdate()
    {
        $date_now = Carbon::now();
        if ($date_now >= '2021-01-31') {
            if ($date_now > '2021-02-28') {
                if ($date_now > '2021-03-31') {
                    if ($date_now > '2021-04-30') {
                        if ($date_now > '2021-05-31') {
                            if ($date_now > '2021-06-30') {
                                if ($date_now > '2021-07-31') {
                                    if ($date_now > '2021-08-31') {
                                        if ($date_now > '2021-09-30') {
                                            if ($date_now > '2021-10-31') {
                                                if ($date_now > '2021-11-30') {
                                                    if ($date_now > '2021-12-31') {
                                                    } else {
                                                        return '2021-12-01';
                                                    }
                                                } else {
                                                    return '2021-11-01';
                                                }
                                            } else {
                                                return '2021-10-01';
                                            }
                                        } else {
                                            return '2021-09-01';
                                        }
                                    } else {
                                        return '2021-08-01';
                                    }
                                } else {
                                    return '2021-07-01';
                                }
                            } else {
                                return '2021-06-01';
                            }
                        } else {
                            return '2021-05-01';
                        }
                    } else {
                        return '2021-04-01';
                    }
                } else {
                    return '2021-03-01';
                }
            } else {
                return '2021-02-01';
            }
        } else {
            return '2021-01-01';
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
