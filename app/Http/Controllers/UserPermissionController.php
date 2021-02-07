<?php

namespace App\Http\Controllers;

use App\Models\UserPermission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    //
    public function index()
    {
        $data = UserPermission::get();
        return response()->success($data);
    }

    public function show($id)
    {

       $data = UserPermission::find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลที่ต้องการ'], '40');
        }
    }

    public function update(Request $request,$id)
    {
            $datas = $request->validate([
                'permission' => '',
            ]);
            $permission = UserPermission::find($id);
            if (!$permission) {
                return response()->error(['ไม่พบข้อมูลที่ต้องการ'], '40');
            }
            $result = $permission->update($datas);
            if (!$result) {
                return response()->error(['แก้ไขไม่สำเร็จ'], '40');
            }
            return response()->success($permission->toArray(), [], '0', 200);

    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'user_id'=>'required',
            'permission' => 'required',
        ]);

        $data = [
            'user_id'=>$datas['customer_id'],
            'permission' => $datas['value'],
        ];

        $permission = UserPermission::create($data);

        if (!$permission) {
            return response()->error(['ไม่สามารถเพิ่มข้อมูลได้'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }
    
     public function destroy($id)
    {
         return UserPermission::findOrFail($id)->delete();

    }

}
