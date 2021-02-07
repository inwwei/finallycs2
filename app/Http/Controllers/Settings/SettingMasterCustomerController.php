<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\SettingMasterCustomer;
use Illuminate\Http\Request;

class SettingMasterCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas =  SettingMasterCustomer::with('children')
        ->whereNull('ref_id')->orderBy('id')->get();
        if (!$datas) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($datas, [], '0', 200);
        }
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
    {$datas = $request->validate([
        'ref_id' => 'required',
        'name_th' => 'required',
        'name_en' => 'required'

    ]);
    // ];
    $settingCustomer = SettingMasterCustomer::create($datas);

    if (!$settingCustomer) {
        return response()->error(['ไม่สามารถแก้ไขข้อมูลได้'], '40');
    } else {
        return response()->success($settingCustomer, [], '0', 200);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings\SettingMasterCustomer  $settingMasterCustomer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SettingMasterCustomer::withTrashed()->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings\SettingMasterCustomer  $settingMasterCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingMasterCustomer $settingMasterCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings\SettingMasterCustomer  $settingMasterCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datas = $request->validate([

            'ref_id' => 'required',
            'name_th' => 'required',
            'name_en' => 'required'

        ]);
        $settingCustomer = SettingMasterCustomer::find($id);
        if (!$settingCustomer) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $settingCustomer->update($datas);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($settingCustomer->toArray(), [], '0', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings\SettingMasterCustomer  $settingMasterCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $settingCustomer = SettingMasterCustomer::find($id);
        if (!$settingCustomer) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $settingCustomer->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return response()->success($settingCustomer->toArray(), [], '0', 200);
    }

    public function getPartner()
    {
        $datas =  SettingMasterCustomer::with('children')
        ->where('ref_id','6F8F8778-3EDD-4D1C-8FDC-F9FF585BA69F')->orderBy('id')->get();
        if (!$datas) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($datas, [], '0', 200);
        }
    }
}
