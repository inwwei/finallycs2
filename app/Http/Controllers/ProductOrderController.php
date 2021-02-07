<?php

namespace App\Http\Controllers;

use App\Models\Orders\Order;
use App\Models\Orders\OrderDetail;
use App\Models\Product\Product;
use App\Models\Settings\SettingBasicBranch;
use App\Models\Settings\SettingGenerateCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductOrderController extends Controller
{
    public function index()
    {
        $data = Order::with(['user','user.settingMasterUser','settingMasterCustomer','settingMasterProduct'])->orderBy('created_at')->get();
        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'partner_id' => 'required',
            'user_id' => 'required',
            'setting_master_product_id' => 'required',
            'code_ref' => 'sometimes',
            'total_price' => 'required',
            'type' => 'required',
            'status' => 'required',
            'product_details' => 'sometimes',

        ]);
        $datas['print'] = 'ไม่สำเร็จ';
        $datas['code'] = orderProductGenerateCode($request->name_th,$datas['setting_master_product_id']);
        $datas['now'] = Carbon::now();
        $order = Order::create($datas);

        if(isset($datas['product_details'])){
            foreach($datas['product_details'] as $detail){
                $detail['order_id'] = $order->id;
                OrderDetail::create($detail);
            }
        }

        if (!$order) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($order, [], '0',  200);
        }
    }

    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'partner_id' => 'required',
            'user_id' => 'required',
            'setting_master_product_id' => 'required',
            'code_ref' => 'sometimes',
            'total_price' => 'sometimes',
            'type' => 'sometimes',
            'status' => 'sometimes',
            'print' => 'sometimes'
        ]);

        $order = Order::find($id);
        if (!$order) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $order->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($order->toArray(), [], '0',  200);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
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
        $data = Order::withTrashed()->with(['user','user.SettingBasicBranch','user.settingMasterUser','settingMasterCustomer','settingMasterCustomer.customer','settingMasterCustomer.customer.customerContacts','settingMasterProduct'])->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
    }
}
