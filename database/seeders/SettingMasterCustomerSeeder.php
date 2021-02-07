<?php

namespace Database\Seeders;

use App\Models\Settings\SettingMasterCustomer;
use Illuminate\Database\Seeder;

class SettingMasterCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
                ['id' => '9F42062B-9A3F-4835-B083-CEA66F5C97C9', 'ref_id' => null, 'name_th' => 'ระดับสมาชิก', 'name_en' => 'Level Customer'],
                ['id' => '6F8F8778-3EDD-4D1C-8FDC-F9FF585BA69F', 'ref_id' => '9F42062B-9A3F-4835-B083-CEA66F5C97C9', 'name_th' => 'คู่ค้า', 'name_en' => 'Partner'],
                ['id' => 'BEA26746-3731-4D60-BA5D-D725541FCC58', 'ref_id' => '6F8F8778-3EDD-4D1C-8FDC-F9FF585BA69F', 'name_th' => 'ไอเอสที', 'name_en' => 'IST'],
                ['id' => 'A63B3B65-D516-471D-B42B-DD9769869C52', 'ref_id' => '6F8F8778-3EDD-4D1C-8FDC-F9FF585BA69F', 'name_th' => 'ตรีเพชรอิซูซุ', 'name_en' => 'TrepatchIsuzu'],
                ['id' => '258E5592-E890-4E96-97D4-CB32AF6BC16E', 'ref_id' => '9F42062B-9A3F-4835-B083-CEA66F5C97C9', 'name_th' => 'ลูกค้า', 'name_en' => 'Customer'],
                ['id' => '7094C37D-B95C-44AB-A273-4C9BD4673235', 'ref_id' => '258E5592-E890-4E96-97D4-CB32AF6BC16E', 'name_th' => 'ปกติ', 'name_en' => 'Normal'],
                ['id' => 'BE3A0628-C432-4D94-88BF-948DD0CAE3F1', 'ref_id' => '258E5592-E890-4E96-97D4-CB32AF6BC16E', 'name_th' => 'พิเศษ', 'name_en' => 'Vip'],
                ['id' => '337B2FC6-150D-4C5E-8BA2-2C33466C95EE', 'ref_id' => '258E5592-E890-4E96-97D4-CB32AF6BC16E', 'name_th' => 'สุดพิเศษ', 'name_en' => 'Svip'],
        ];
        foreach($datas as $data){
            SettingMasterCustomer::create($data);
        }
    }
}
