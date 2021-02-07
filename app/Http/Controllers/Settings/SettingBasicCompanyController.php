<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\SettingBasicCompany;
use Illuminate\Http\Request;

class SettingBasicCompanyController extends Controller
{

    public function index()
    {
        $data = SettingBasicCompany::orderBy('created_at')->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'name' => 'required',
            'tex_id' => 'required',
            'tel' => 'required',
            'house_number'=>'required',
            'district'=>'required',
            'amphure'=>'required',
            'province'=>'required',
            'postal_code'=>'required',
        ]);

        $data = SettingBasicCompany::create($datas);

        if (!$data) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($data, [], '0',  200);
        }
    }

    public function show($id)
    {
        $data = SettingBasicCompany::withTrashed()->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
    }

    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'name' => 'required',
            'tex_id' => 'required',
            'tel' => 'required',
            'house_number'=>'required',
            'district'=>'required',
            'amphure'=>'required',
            'province'=>'required',
            'postal_code'=>'required',
        ]);

        $data = SettingBasicCompany::find($id);

        $result = $data->update($datas);

        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($data->toArray(), [], '0',  200);

    }

    public function destroy($id)
    {
        $data = SettingBasicCompany::find($id);
        if (!$data) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $data->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return  response()->success($data->toArray(), [], '0',  200);
    }
}
