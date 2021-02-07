<?php

namespace App\Http\Controllers;

use App\Models\UserContact;
use Illuminate\Http\Request;

class UserContactController extends Controller
{
    public function index($user_id)
    {
        $data = UserContact::with(['settingMasterContact'])->where('user_id', $user_id)->orderBy('created_at')->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'user_id' => 'required',
            'setting_master_contact_id' => 'required',
            'value' => 'sometimes',
            'house_number'=>'sometimes',
            'district'=>'sometimes',
            'amphure'=>'sometimes',
            'province'=>'sometimes',
            'postal_code'=>'sometimes',
        ]);

        $data = UserContact::create($datas);

        if (!$data) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($data, [], '0',  200);
        }
    }

    public function show($user_id, $id)
    {
        $data = UserContact::withTrashed()->with(['settingMasterContact'])->where('user_id', $user_id)->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
    }

    public function update($user_id, Request $request, $id)
    {
        $datas = $request->validate([
            'user_id' => 'required',
            'setting_master_contact_id' => 'required',
            'value' => 'sometimes',
            'house_number'=>'sometimes',
            'district'=>'sometimes',
            'amphure'=>'sometimes',
            'province'=>'sometimes',
            'postal_code'=>'sometimes',
        ]);

        $user = UserContact::where('user_id', $user_id)->find($id);
        if (!$user) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $user->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($user->toArray(), [], '0',  200);
    }

    public function destroy($user_id, $id)
    {
        $user = UserContact::where('user_id', $user_id)->find($id);

        if (!$user) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $user->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return  response()->success($user->toArray(), [], '0',  200);

    }
}
