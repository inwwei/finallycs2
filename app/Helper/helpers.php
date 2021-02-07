<?php

use App\Http\Controllers\ProductOrderController;
use App\Models\Orders\Order;
use App\Models\Sales\SaleProduct;
use App\Models\Settings\SettingBasicBranch;
use App\Models\Settings\SettingGenerateCode;
use Carbon\Carbon;

function sumSaleProductPrice($saleTableArray) {
    $sumPrice = 0;
    foreach($saleTableArray as $saleTable){
        $sumPrice += $saleTable['totalPrice'];
    }
    return $sumPrice;
}
function saleProductGenerateCode($code_type) {
    $test = SettingGenerateCode::where('name',$code_type)->first();
    $count = SaleProduct::count()+1;
    $number= str_pad($count, 4, "0", STR_PAD_LEFT);
    $get_branch = SettingBasicBranch::where('branch_code','01')->first();
    $branch = $get_branch->branch_code;
    $date = Carbon::now()->add(543, 'year')->isoFormat('YYMM');
    return $test->code.'-'.$branch.$date.$number;
}
function orderProductGenerateCode($name_th,$setting_master_product_id) {
    if($name_th == 'ตัวรถ'){
        $test = SettingGenerateCode::where('name','ใบสั่งซื้อ(รถ)')->first();
    }else{
        $test = SettingGenerateCode::where('name','ใบรายการสั่งซื้อ(อะไหล่)')->first();
    }
    $count = Order::where('setting_master_product_id',$setting_master_product_id)->count()+1;
    $number= str_pad($count, 4, "0", STR_PAD_LEFT);
    $get_branch = SettingBasicBranch::where('branch_code','01')->first();
    $branch = $get_branch->branch_code;
    $date = Carbon::now()->add(543, 'year')->isoFormat('YYMM');
    return $test->code.'-'.$branch.$date.$number;
}