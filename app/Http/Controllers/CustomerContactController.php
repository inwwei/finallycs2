<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerContact;

class CustomerContactController extends Controller
{
    //
     public function index($customer_id)
    {
       $data = CustomerContact::with('settingMasterContact')->where('customer_id', $customer_id)->get();
            return response()->success($data);

    }
    public function show($customer_id,$id)
    {
            $data = CustomerContact::with('settingMasterContact')->withTrashed()->where('customer_id', $customer_id)->find($id);
            if ($data) {
                return response()->success($data);
            } else {
                return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
            }
    }
     public function update(Request $request,$id,$customer_id)
    {
            $datas = $request->validate([
                'value' => 'sometimes',
                'setting_master_contact_id' => 'required',
                'house_number'=>'sometimes',
                'district'=>'sometimes',
                'amphure'=>'sometimes',
                'province'=>'sometimes',
                'postal_code'=>'sometimes',
            ]);
            $contact = CustomerContact::find($customer_id);
            if (!$contact) {
                return response()->error(['ไม่พบข้อมูลช่องทางการติดต่อที่ต้องการ'], '40');
            }
            $result = $contact->update($datas);
            if (!$result) {
                return response()->error(['แก้ไขไม่สำเร็จ'], '40');
            }
            return response()->success($contact->toArray(), [], '0', 200);

    }
    public function store($id,Request $request)
    {
        $datas = $request->validate([
            'customer_id'=>'required',
            'value' => 'sometimes',
            'setting_master_contact_id' => 'required',
            'house_number'=>'sometimes',
            'district'=>'sometimes',
            'amphure'=>'sometimes',
            'province'=>'sometimes',
            'postal_code'=>'sometimes',
        ]);
        $contact = CustomerContact::create($datas);

        if (!$contact) {
            return response()->error(['ไม่สามารถเพิ่มข้อมูลได้'], '40');
        } else {
            return response()->success($datas, [], '0', 200);
        }
    }
     public function destroy($customer_id, $id)
    {
         $customerContact = CustomerContact::where('customer_id', $customer_id)->find($id);

         if (!$customerContact) {
             return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
         }
         $result = $customerContact->delete();
         if (!$result) {
             return response()->error(['ทำการลบไม่สำเร็จ'], '40');
         }
         return  response()->success($customerContact->toArray(), [], '0',  200);
    }

}
