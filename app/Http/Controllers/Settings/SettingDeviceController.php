<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\SettingDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SettingDeviceController extends Controller
{

    public function index()
    {
        $data = SettingDevice::orderBy('id')->get();

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
            'pin' => 'required',
        ]);

        $settingDevice = SettingDevice::create($datas);

        if (!$settingDevice) {
            return response()->error(['ไม่สามารถแก้ไขข้อมูลได้'], '40');
        } else {
            return response()->success($settingDevice, [], '0', 200);
        }
    }

    public function usepin(Request $request)
    {
        $datas = $request->validate([
            'pin' => 'required',
        ]);

        $settingDevice = SettingDevice::where('pin', $datas['pin'])
            ->whereNull('use_at')->first();

        if ($settingDevice) {
            $settingDevice->use_at = Carbon::now();
            if ($settingDevice->save()) {
                return response()->success($settingDevice, [], '0', 200);
            }
        }
        return response()->error(['ไม่พบข้อมูล PIN ที่จะใช้งาน หรือ ถูกใช้งานไปแล้ว'], '40');
    }

    public function checkpin(Request $request)
    {
        $datas = $request->validate([
            'pin' => 'required',
        ]);

        $data = SettingDevice::where('pin', $datas['pin'])
            ->whereNotNull('use_at')->first();
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูล PIN'], '40');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings\SettingDevice  $settingDevice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SettingDevice::withTrashed()->find($id);
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
            'pin' => 'required',
        ]);

        $data = SettingDevice::find($id);

        $result = $data->update($datas);

        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($data->toArray(), [], '0',  200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings\SettingDevice  $settingDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $settingDevice = SettingDevice::find($id);
        if (!$settingDevice) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $settingDevice->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return response()->success($settingDevice->toArray(), [], '0', 200);
    }
}
