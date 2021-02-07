<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Sales\SaleProduct;
use App\Models\Sales\SaleProductDetail;
use App\Models\Settings\SettingBasicBranch;
use App\Models\Settings\SettingGenerateCode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleProductController extends Controller
{
    public function index()
    {
        $data = SaleProduct::with('customer','employee')->get();
        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'seller_id' => 'required',
            'customer_id' => 'required',
            'date' => 'required',
            'code_type' => 'required',
            'print' => 'required',
            'sumPrice' => 'sometimes',
            'saleTables.*.id' => 'sometimes',
            'saleTables.*.quantity' => 'sometimes',
            'saleTables.*.wholesale_price' => 'sometimes',
            'saleTables.*.totalPrice' => 'sometimes',
            ]);
        $datas['date']= Carbon::now();
        $datas['code'] = saleProductGenerateCode($datas['code_type']);
        $datas['sumPrice'] = sumSaleProductPrice($datas['saleTables']);
        $sell = SaleProduct::create($datas);

        if(isset($datas['saleTables'])){
            foreach($datas['saleTables'] as $detail){
                $detail['sell_id'] = $sell->id;
                $detail['product_id'] = $detail['id'];
                $detail['amount'] = $detail['quantity'];
                $detail['total_price'] = $detail['totalPrice'];
                $product = Product::where('id',$detail['product_id'])->first();
                $product->quantity = ($product->quantity * 1 ) -  $detail['amount'];
                $test = Product::where('id',$detail['product_id'])->update(['quantity'=> $product->quantity]);
                SaleProductDetail::create($detail);
            }
        }

        if (!$sell) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($sell, [], '0',  200);
        }
    }

    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'seller_id' => 'required',
            'customer_id' => 'required',
            'print' => 'sometimes'
        ]);

        $sell = SaleProduct::find($id);
        if (!$sell) {
            return response()->error(['ไม่พบข้อมูล'], '40');
        }
        $result = $sell->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($sell->toArray(), [], '0',  200);
    }

    public function destroy($id)
    {
        $sell = SaleProduct::find($id);
        $details = SaleProductDetail::where('sell_id',$id)->get();
        if(isset($details)){
            foreach($details as $detail){
                $product = Product::where('id',$detail->product_id)->first();
                $product->quantity = ($product->quantity * 1 ) +  $detail->amount;
                Product::where('id',$detail->product_id)->update(['quantity'=> $product->quantity]);
            }
        }
        
        if (!$sell) {
            return response()->error(['ไม่พบข้อมูล'], '40');
        }
        $result = $sell->delete();

        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        } else{
            return  response()->success($sell->toArray(), [], '0',  200);
        }
    }

    public function show($id)
    {
        $data = SaleProduct::with('customer','employee','saleProductDetail')->withTrashed()->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูล'], '40');
        }
    }
}
