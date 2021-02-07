<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Sales\SaleProductDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleProductDetailController extends Controller
{
    public function index($sell_id)
    {
        $data = SaleProductDetail::with('product','employee')->where('sell_id',$sell_id)->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'sell_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required',
            'wholesale_price' => 'required',
            'total_price' => 'sometimes',
        ]);

        $datas['now'] = Carbon::now();
        
        $detail = SaleProductDetail::create($datas);
        if (!$detail) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($detail, [], '0',  200);
        }
    }

    public function update(Request $request, $sell_id, $id)
    {
        $datas = $request->validate([
            'sell_id' => 'required',
            'product_id' => 'required',
            'amount' => 'required',
            'wholesale_price' => 'required',
            'total_price' => 'sometimes',
        ]);

        $detail = SaleProductDetail::where('sell_id',$sell_id)->find($id);

        if (!$detail) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $detail->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($detail->toArray(), [], '0',  200);
    }

    public function destroy($sell_id,$id)
    {
        $sell = SaleProductDetail::where('sell_id', $sell_id)->find($id);
        $product = Product::where('id',$sell->product_id)->first();
        $product->quantity = $product->quantity + $sell->amount;
        Product::where('id',$sell->product_id)->update(['quantity' => $product->quantity]); 
        if (!$sell) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $sell->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        } else{
            return  response()->success($sell->toArray(), [], '0',  200);
        }
    }

    public function show($sell_id)
    {
        $data = SaleProductDetail::withTrashed()->with(['product','employee'])->where('sell_id',$sell_id)->get();
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
    }
}
