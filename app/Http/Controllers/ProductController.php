<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Settings\SettingMasterProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getSetting()
    {
        $type = ['อะไหล่','อุปกรณ์ต่อพ่วง','ตัวรถ'];
        $data = SettingMasterProduct::whereIn('name_th',$type)->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function index()
    {
        $data = Product::with('settingMasterProduct','settingBasicBranch')->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }
    public function getProductWithBranch($branch_id)
    {
        $data = Product::with('settingMasterProduct','settingBasicBranch')->where('setting_basic_branch_id',$branch_id)->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
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
            'setting_master_product_id' => 'required',
            'setting_basic_branch_id' => 'required',
            'machine_code' => 'sometimes',
            'vin' => 'sometimes',
            'description' => 'required',
            'tags' => 'sometimes',
            'quantity' => 'required',
            'retail_price' => 'required',
            'wholesale_price' => 'required',
            'tags' => 'sometimes',
            'date' => 'sometimes',
            'type_received' => 'required',

        ]);


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
        $data = Product::with('settingMasterProduct','settingBasicBranch')->withTrashed()->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
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
        return "test";
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
        // return $request;
        $datas = $request->validate([
            'setting_master_product_id' => 'required',
            'setting_basic_branch_id' => 'required',
            'machine_code' => 'sometimes',
            'vin' => 'sometimes',
            'description' => 'required',
            'tags' => 'sometimes',
            'quantity' => 'required',
            'retail_price' => 'required',
            'wholesale_price' => 'required',
            'tags' => 'sometimes',
            'date' => 'sometimes',

        ]);

        $product = Product::with('settingMasterProduct')->find($id);
        if(!$product){
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }

        $result = false;
        if ( $product->settingMasterProduct->type == 'อะไหล่') {
            $new_quantity = $product->quantity + $datas['new_quantity'];
            $product->fill($datas);
            $product->quantity = $new_quantity;
            $result = $product->save();
        } else {
            $result = $product->update($datas);
        }

        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($product->toArray(), [], '0', 200);
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
