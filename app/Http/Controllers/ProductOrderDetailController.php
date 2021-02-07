<?php

namespace App\Http\Controllers;

use App\Models\Orders\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductOrderDetailController extends Controller
{

    public function getReceivs()
    {
        $data = OrderDetail::with('settingMasterProduct','order')->where('type','สั่ง')->orderBy('created_at')->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data->toArray(), [], '0',  200);
        }
    }

    public function index($order_id)
    {
        $data = OrderDetail::where('order_id',$order_id)->with('settingMasterProduct')->orderBy('created_at')->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'order_id' => 'required',
            'setting_master_product_id' => 'required',
            'amount' => 'required',
            'wholesale_price' => 'required',
            'total_price' => 'sometimes',
        ]);

        $datas['now'] = Carbon::now();

        $order = OrderDetail::create($datas);

        if (!$order) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($order, [], '0',  200);
        }
    }

    public function update($order_id,Request $request, $id)
    {
        $datas = $request->validate([
            'order_id' => 'required',
            'setting_master_product_id' => 'required',
            'amount' => 'required',
            'wholesale_price' => 'required',
            'total_price' => 'sometimes',
        ]);

        $order = OrderDetail::where('order_id', $order_id)->find($id);
        if (!$order) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $order->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($order->toArray(), [], '0',  200);
    }

    public function destroy($order_id,$id)
    {
        $order = OrderDetail::where('order_id', $order_id)->find($id);
        if (!$order) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $order->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        } else{
            return  response()->success($order->toArray(), [], '0',  200);
        }
    }

    public function show($id)
    {
        $data = OrderDetail::withTrashed()->where('order_id',$id)->get();

        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
    }
}
