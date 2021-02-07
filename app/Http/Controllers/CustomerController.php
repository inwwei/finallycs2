<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\Settings\SettingMasterCustomer;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::with('customerContacts','customerLog')->get();
        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }

    public function show($id)
    {
        $data = Customer::withTrashed()->with(['settingBasicBranch','customerContacts'])->find($id);
        if ($data) {
            return response()->success($data);
        } else {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'code' => 'sometimes',
            'customer_name' => 'required',
            'identification_number' => 'required',
            'setting_master_customer_id' => 'required',
            'setting_basic_branch_id'=>'required',
            'tax_id' =>'sometimes',
            'customer_contact.*.value' => 'sometimes',
            'customer_contact.*.setting_master_contact_id' => 'sometimes',
            'customer_contact.*.house_number' => 'sometimes',
            'customer_contact.*.district' => 'sometimes',
            'customer_contact.*.amphure' => 'sometimes',
            'customer_contact.*.province' => 'sometimes',
            'customer_contact.*.postal_code' => 'sometimes',
        ]);
        $customer = Customer::create($datas);
        if (isset($datas['customer_contact'])) {
            $contacts = $datas['customer_contact'];
            foreach ($contacts as $contact) {
                $contact['customer_id'] = $customer->id;
                CustomerContact::create($contact);
            }
        }
        return response()->success($customer, [], '0', 200);

        if (!$customer) {
            return response()->error(['ไม่สามารถเพิ่มข้อมูลได้'], '40');
        } else {
            return response()->success($customer, [], '0', 200);
        }
        if (!$contact) {
            return response()->error(['ไม่สามารถเพิ่มข้อมูลได้'], '40');
        } else {
            return response()->success($contact, [], '0', 200);
        }
    }

    public function update(Request $request, $id)
    {
        // ทำงานผิด มันต้องเป็นการ Update ของเรื่อง customer เฉยๆ ไม่เกี่ยวอะไรกับ contact
        $datas = $request->validate([
            'code' => 'sometimes',
            'customer_name' => 'required',
            'identification_number' => 'required',
            'setting_master_customer_id'=>'required',
            'setting_basic_branch_id'=>'required',
            'tax_id' => 'required'
        ]);
    //    $datas['setting_basic_branch_id'] = $datas['setting_basic_branch_id']['id'];
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->error(['ไม่พบข้อมูลสมาชิกที่ต้องการ'], '40');
        }
        $result = $customer->update($datas);
        // $customer->customerContacts()->update(['id'=> 'jdaskldjkl', 'value' => '09xxxxxxx']);
        if (!$result) {
            return response()->error(['แก้ไขไม่สำเร็จ'], '40');
        }
        return response()->success($customer->toArray(), [], '0', 200);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $customer->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return response()->success($customer->toArray(), [], '0', 200);
    }

    public function getPartner()
    {
        $data = SettingMasterCustomer::with('customer')->where('ref_id','6F8F8778-3EDD-4D1C-8FDC-F9FF585BA69F')->get();

        // $data = Customer::with('settingMasterCustomer')->where('setting_master_customer_id', 'BEA26746-3731-4D60-BA5D-D725541FCC58')->orWhere('setting_master_customer_id', '6F8F8778-3EDD-4D1C-8FDC-F9FF585BA69F')->get();
        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }
}
