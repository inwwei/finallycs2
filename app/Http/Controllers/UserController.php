<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function user_data_all()
    {
        $data = User::get();
        return response()->success($data, [], '0', 200);
    }

    public function getUser()
    {
        $data = Auth::user();
        return response()->success($data, [], '0', 200);
    }

    public function getLoginUser()
    {
        $ActiveUser = Auth::user();
        return $ActiveUser;
    }

    public function index()
    {
        $data = User::with('settingMasterUser', 'settingBasicBranch')->get();

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }
public function register(){{
    $datas = $request->validate([
        'financial' => 'required',
        'name' => 'required',
        'identification_number' => 'required',
        'username' => 'required',
        'email' => 'required',
        'password' => 'required',
    ]);
    $password =  $datas['password'];
    if ($datas['password'] = 'password') {
        $datas['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
    } else {
        $datas['password'] = Hash::make($password);
    }
    $datas['now'] = Carbon::now();

    $user = User::create($datas);

    // if (isset($datas['user_contacts'])) {
    //     foreach ($datas['user_contacts'] as $contact) {
    //         $contact['user_id'] = $user->id;
    //         UserContact::create($contact);
    //     }
    // }

    if (!$user) {
        return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
    } else {
        return response()->success($user, [], '0',  200);
    }
}}
    public function store(Request $request)
    {
        $datas = $request->validate([
            'financial' => 'required',
            'name' => 'required',
            'identification_number' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $password =  $datas['password'];
        if ($datas['password'] = 'password') {
            $datas['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        } else {
            $datas['password'] = Hash::make($password);
        }
        $datas['now'] = Carbon::now();

        $user = User::create($datas);

        // if (isset($datas['user_contacts'])) {
        //     foreach ($datas['user_contacts'] as $contact) {
        //         $contact['user_id'] = $user->id;
        //         UserContact::create($contact);
        //     }
        // }

        if (!$user) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($user, [], '0',  200);
        }
    }

    public function update(Request $request, $id)
    {
        return $request;
        $datas = $request->validate([
            'name' => 'sometimes',
            'identification_number' => 'sometimes',
            'username' => 'sometimes',
            'email' => 'required',
            'password' => 'sometimes',
            'email'=> 'sometimes',
            'ceo_prefix'=> 'sometimes',
            'ceo_firstname'=> 'sometimes',
            'ceo_lastname'=> 'sometimes',
            'company_tel'=> 'sometimes',
            'ceo_tel'=> 'sometimes',
            'amphoe'=> 'sometimes',
            'district'=> 'sometimes',
            'province'=> 'sometimes',
            'postal_code'=> 'sometimes',
            'lat'=> 'sometimes',
            'lng'=> 'sometimes',
            'role'=> 'sometimes',
        ]);
        $password =  $datas['password'];
        if ($datas['password'] = 'password') {
            $datas['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        } else {
            $datas['password'] = Hash::make($password);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $user->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($user->toArray(), [], '0',  200);
    }
    public function update_profile(Request $request, $id)
    {

        $datas = $request->validate([
            'name' => 'sometimes',
            'identification_number' => 'sometimes',
            'username' => 'sometimes',
            'email' => 'required',
            'password' => 'sometimes',
            'email'=> 'sometimes',
            'ceo_prefix'=> 'sometimes',
            'ceo_firstname'=> 'sometimes',
            'ceo_lastname'=> 'sometimes',
            'company_tel'=> 'sometimes',
            'ceo_tel'=> 'sometimes',
            'amphoe'=> 'sometimes',
            'district'=> 'sometimes',
            'province'=> 'sometimes',
            'postal_code'=> 'sometimes',
            'lat'=> 'sometimes',
            'lng'=> 'sometimes',
            'role'=> 'sometimes',
        ]);
        $password =  $datas['password'];
        if ($datas['password'] = 'password') {
            $datas['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        } else {
            $datas['password'] = Hash::make($password);
        }
        $user = User::find($request->id);
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
        $data = User::with(['product'])->find($id);

        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
    }
}
