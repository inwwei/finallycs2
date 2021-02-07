<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\SettingGenerateCode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingGenerateCodeController extends Controller
{
    public function index()
    {
        $datas =  SettingGenerateCode::with('settingBasicBranch')->get();
        if (!$datas) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($datas, [], '0', 200);
        }
        // $code = 'MT-';
        // $count = 1;
        // $date=Carbon::now()->add(543, 'year')->isoFormat('YYMM');
        // $number= str_pad($count, 4, "0", STR_PAD_LEFT);
        // $generate = $code . $date . $number;
        // echo($generate);
    }
    public function store(Request $request)
    {
        $datas = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'setting_basic_branch_id'=>'required'
        ]);
        $datas['pattern'] = 'CODE-BRANCHYYMMRRRR';

        $data = SettingGenerateCode::create($datas);

        if (!$data) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($data, [], '0',  200);
        }
    }
    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'name' =>'required',
            'code' => 'required',
            'setting_basic_branch_id'=>'required'
        ]);
        $code_setting = SettingGenerateCode::find($id);
        if (!$code_setting) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $code_setting->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($code_setting->toArray(), [], '0', 200);
    }
    public function show($id)
    {
        $data = SettingGenerateCode::with('settingBasicBranch')->withTrashed()->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }//
    }
    public function destroy($id)
    {
        $code_setting = SettingGenerateCode::find($id);
        if (!$code_setting) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $code_setting->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return  response()->success($code_setting->toArray(), [], '0',  200);
    }
}
