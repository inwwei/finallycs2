<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Settings\SettingMasterProduct;
use Illuminate\Http\Request;

class SettingMasterProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getSetting()
    {
        // $data = Product::with('settingMasterProduct')->get();
        // return response()->success($data);

        $datas = Product::with('settingMasterProduct')->whereHas('settingMasterProduct', function ($query) {
            $query->where('type', 'อะไหล่');
        })->get();
        return response()->success($datas);

        // $datas = SettingMasterProduct::with('children')->where('type','อะไหล่')->orderBy('id')->get();
        // return response()->success($datas);
    }

    public function index()
    {
        $datas = SettingMasterProduct::with('children')->whereNull('ref_id')->orderBy('id')->get();
        return response()->success($datas);
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
            'ref_id' => 'sometimes',
            'code' => 'sometimes',
            'name_th' => 'required',
            'name_en' => 'required',
            'type' => 'required',

            'retail_price' => 'required',

        ]);
        $product = SettingMasterProduct::create($datas);

        if (!$product) {
            return response()->error(['ไม่สามารถเพิ่มข้อมูลได้'], '40');
        } else {
            return response()->success($product, [], '0', 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings\SettingMasterProduct  $settingMasterProduct
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SettingMasterProduct::with('product')->withTrashed()->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }

    }

    public function getProduct($id)
    {
        $datas = SettingMasterProduct::with('children')->where('id',$id)->orderBy('id')->get();
        return response()->success($datas);

        $data = SettingMasterProduct::where('ref_id',$id)->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings\SettingMasterProduct  $settingMasterProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingMasterProduct $settingMasterProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings\SettingMasterProduct  $settingMasterProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingMasterProduct $settingMasterProduct)
    {
        $datas = $request->validate([
            'ref_id' => 'sometimes',
            'code' => 'sometimes',
            'name_th' => 'required',
            'name_en' => 'required',
            'type' => 'required',

            'retail_price' => 'required',

        ]);

        $product = SettingMasterProduct::find($request->id);
        if (!$product) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการปปปปปปป'], '40');
        }
        $result = $product->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($result, [], '0', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings\SettingMasterProduct  $settingMasterProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = SettingMasterProduct::find($id);
        if (!$product) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $product->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return response()->success($product, [], '0', 200);
    }
}
