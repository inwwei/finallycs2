<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    public function index()
    {
        $data = User::get();
        // $data = User::with('userPermission')->get();
        return response()->success($data);
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'tel' => 'required',
            'setting_master_users_id' => 'required',
            'branch' => 'required',

            // 'permission' => 'required',
        ]);

        $dataUser = [
            'name' => $datas['name'],
            'address' => $datas['address'],
            'tel' => $datas['tel'],
            'setting_master_users_id' => $datas['setting_master_users_id'],
            'branch' => $datas['branch']
        ];

        $user = User::create($dataUser);

        // $user_id = User::where('name',$datas['name'])->first()->id;

        // $userPermission=[
        //     'user_id' => $user_id,
        //     'permission' => $datas['permission'],
        // ];

        // $permission = UserPermission::create($userPermission);

        if (!$user) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        }else{
            return response()->success($user, [], '0',  201);
        }

        // if (!$permission) {
        //     return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        // }else{
        //     return response()->success($permission, [], '0',  201);
        // }


    }

    // public function demo()
    // {
    //     $data = User::create([
    //         'name' => 'Mr.JIMMY',
    //         'email' => 'test@iseki.test',
    //         'email_verified_at' => now(),
    //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    //     ]);

    //     // dd(now());

    //     User::factory()
    //         ->times(50)
    //         ->create();
    //     return 'success';
    // }

    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'tel' => 'required',
            'position' => 'required',
            'branch' => 'required',
        ]);
        $user = User::find($id);

        // $user = User::with('userPermission')->find($id);
        if (!$user) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $user->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($user->toArray(), [], '0',  200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $user->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return  response()->success($user->toArray(), [], '0',  200);
    }

    public function show($id)
    {
        $data = User::withTrashed()->find($id);
        // $data = User::withTrashed()->with('userPermission')->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
    }

}
