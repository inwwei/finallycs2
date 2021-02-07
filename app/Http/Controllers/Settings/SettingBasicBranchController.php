<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\SettingBasicBranch;
use Illuminate\Http\Request;

class SettingBasicBranchController extends Controller
{
    public function index()
    {
        $data = SettingBasicBranch::with('settingBasicCompany')->orderBy('created_at')->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'branch_name' => 'required',
            'branch_code' => 'required',
            'company_id' => 'sometimes'
        ]);

        $data = SettingBasicBranch::create($datas);

        if (!$data) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($data, [], '0',  200);
        }
    }

    public function show($id)
    {
        $data = SettingBasicBranch::with('settingBasicCompany')->withTrashed()->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
    }

    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'branch_name' => 'required',
            'branch_code' => 'required',
            'company_id' => 'sometimes'
        ]);

        $data = SettingBasicBranch::find($id);

        $result = $data->update($datas);

        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($data->toArray(), [], '0',  200);

    }

    public function destroy($id)
    {
        $data = SettingBasicBranch::find($id);
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
