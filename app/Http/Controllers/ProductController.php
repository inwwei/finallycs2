<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPostWithCompany()
    {
        $data = Product::with('company')->where('status','ปกติ')->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function index()
    {
        $data = Product::get();
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
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

        $datas = $request->validate([
            'company_id' => 'required',
            'name' => 'required',
            'moisture' => 'sometimes',
            'moisture_min' => 'sometimes',
            'moisture_max' => 'sometimes',
            'Foreign_matter' => 'sometimes',
            'price' => 'required',
            'unit' => 'sometimes',
            'amount' => 'sometimes',

        ]);
$datas['price'] = str_replace(',', '', $datas['price']);
$datas['amount'] = str_replace(',', '', $datas['amount']);
        $datas['status'] = 'ปกติ';
        $product = Product::create($datas);
        if (!$product) {
            return response()->error(['ไม่สามารถแก้ไขข้อมูลได้'], '40');
        } else {
            return response()->success($product, [], '0', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Product::where('company_id',$id)->get();
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
    }
    public function show_announce($id)
    {
        $data = Product::where('company_id',$id)->where('status','ปกติ')->get();
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบ'], '40');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 0D19CD2E-A654-4789-958A-2DA4EDB74786
        $product = Product::find('0D19CD2E-A654-4789-958A-2DA4EDB74786');
        $product->name = "wei";
        $product->save();
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
        $datas = $request->validate([
            'id' => 'required',
            'company_id' => 'required',
            'name' => 'required',
            'moisture' => 'sometimes',
            'moisture_min' => 'sometimes',
            'moisture_max' => 'sometimes',
            'Foreign_matter' => 'sometimes',
            'price' => 'required',
            'unit' => 'sometimes',
            'amount' => 'sometimes',
        ]);
        $datas['price'] = str_replace(',', '', $datas['price']);
        $datas['amount'] = str_replace(',', '', $datas['amount']);
        $datas['status'] = 'ปกติ';
        $product = Product::create($datas);
        $query = Product::find($id);
        if (!$product) {
            return response()->error(['ไม่สามารถแก้ไขข้อมูลได้'], '40');
        } else {
            $result = Product::where('id',$query->id)->update(['status'=>'อัพเดท']);
            return response()->success($result, [], '0', 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $product->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return response()->success($product->toArray(), [], '0', 200);
    }
}
