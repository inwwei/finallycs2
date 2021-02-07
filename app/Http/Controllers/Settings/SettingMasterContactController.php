<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\SettingMasterContact;
use Illuminate\Http\Request;

class SettingMasterContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas =  SettingMasterContact::with('children')->whereNull('ref_id')->orderBy('id')->get();
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
            'type' => 'required',
        ]);

        $contact_setting = SettingMasterContact::create($datas);

        if (!$contact_setting) {
            return response()->error(['เพิ่มข้อมูลไม่สำเร็จ'], '40');
        } else {
            return response()->success($contact_setting, [], '0',  200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingMasterContact $SettingMasterContact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SettingMasterContact::withTrashed()->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingMasterContact  $SettingMasterContact
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingMasterContact  $SettingMasterContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'ref_id' => 'required',
            'name_th' => 'required',
            'name_en' => 'required',
            'type' => 'required',
        ]);
        $contact_setting = SettingMasterContact::find($id);
        if (!$contact_setting) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $contact_setting->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($contact_setting->toArray(), [], '0', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingMasterContact $SettingMasterContact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact_setting = SettingMasterContact::find($id);
        if (!$contact_setting) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }
        $result = $contact_setting->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return  response()->success($contact_setting->toArray(), [], '0',  200);
    }
}
