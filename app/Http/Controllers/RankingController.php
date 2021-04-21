<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Product\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

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
// dd($first_date,$end_date);
        $plants = Plant::get();
        $name = [];
        foreach ($plants as $index => $plant) {
            $query_past = Product::where('name', $plant['name'])
            ->where('created_at', '>=', $first_date)->first();
            if(!isset($query_past)) continue;
            // ?? (object) array(
            //     'price_per_kk'=> 15.00
            // );
            $query_present = Product::where('name', $plant['name'])
            ->where('created_at', '<=', $end_date)
            ->orderBy('created_at', 'desc')->first() ??  (object) array(
                'price_per_kk'=> 15.00
            );

            $sum = ($query_present->price_per_kk - $query_past->price_per_kk) / $query_past->price_per_kk;
            // if ($query_present->price_per_kk && $query_past->price_per_kk) {
            //     $sum = ($query_present->price_per_kk - $query_past->price_per_kk) / $query_past->price_per_kk;
            // } else {
            //     $sum = 0;
            // }
            // return $sum;
            $result = [
                'name' => $query_past,
                'sum' => number_format($sum*100,2,),
            ];

            array_push($name, $result);

            // array_push($name, $result);
            // if (isset($result) && !(isset($result['name']->price_per_kk))) {
            //     array_push($name, $result);
            // }
        }

// dd($name);
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
