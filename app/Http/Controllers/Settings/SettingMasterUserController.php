<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\SettingMasterUser;
use Illuminate\Http\Request;

class SettingMasterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas =  SettingMasterUser::with('children')->whereNull('ref_id')->orderBy('id')->get();
        return response()->success($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = $request->validate([
            'ref_id' => 'required',
            'name_th' => 'required',
            'name_en' => 'required',
            'default_financial' => 'required',
            'checkLogin' => 'required',
        ]);

        $user_setting = SettingMasterUser::create($datas);

        if (!$user_setting) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($user_setting, [], '0',  200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings\SettingMasterUser  $settingMasterUser
     * @return \Illuminate\Http\Response
     */
    public function show(SettingMasterUser $settingMasterUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings\SettingMasterUser  $settingMasterUser
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingMasterUser $settingMasterUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings\SettingMasterUser  $settingMasterUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'ref_id' => 'required',
            'name_th' => 'required',
            'name_en' => 'required',
            'default_financial' => 'required',
            'checkLogin' => 'required',
        ]);
        $user_setting = SettingMasterUser::find($id);
        if (!$user_setting) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $user_setting->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($user_setting->toArray(), [], '0', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings\SettingMasterUser  $settingMasterUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_setting = SettingMasterUser::find($id);
        if (!$user_setting) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $user_setting->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return  response()->success($user_setting->toArray(), [], '0',  200);
    }
}
