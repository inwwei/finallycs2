<?php

namespace Database\Seeders;

use App\Models\Settings\SettingMasterUser;
use Illuminate\Database\Seeder;

class SettingMasterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas =[
            ['id' => '92075a3c-3693-4a49-92f6-a1b3244eb5ef', 'ref_id' => null, 'name_th' => 'หมวดหมู่พนักงาน', 'name_en' => 'test', 'checkLogin' => ''],
            ['id' => '92075a3c-3698-4abf-954e-41ee14f64c4f', 'ref_id' => '92075a3c-3693-4a49-92f6-a1b3244eb5ef', 'name_th' => 'งานขาย', 'name_en' => 'test', 'checkLogin' => 'ไม่ล็อกอิน'],
            ['id' => '92075a3c-369d-47e7-9c51-b9c485096344', 'ref_id' => '92075a3c-3693-4a49-92f6-a1b3244eb5ef', 'name_th' => 'งานบริการ', 'name_en' => 'test', 'checkLogin' => 'ไม่ล็อกอิน'],
            ['id' => '92075a3c-36a2-4d0e-bcdc-b7e226269d87', 'ref_id' => '92075a3c-3693-4a49-92f6-a1b3244eb5ef', 'name_th' => 'ออฟฟิศ', 'name_en' => 'test', 'checkLogin' => 'ไม่ล็อกอิน'],
            ['id' => '92075a3c-36a7-462d-8f7d-b535b3409b67', 'ref_id' => '92075a3c-3698-4abf-954e-41ee14f64c4f', 'name_th' => 'หัวหน้าพนักงานขาย', 'name_en' => 'test','default_financial'=>10000, 'checkLogin' => 'ไม่ล็อกอิน'],
            ['id' => '92075a3c-36ab-463a-8ecc-09ab20c68e01', 'ref_id' => '92075a3c-3698-4abf-954e-41ee14f64c4f', 'name_th' => 'พนักงานขาย', 'name_en' => 'test','default_financial'=>10000, 'checkLogin' => 'ไม่ล็อกอิน'],
            ['id' => '92075a3c-36b0-433b-9e34-f129aaab55cb', 'ref_id' => '92075a3c-369d-47e7-9c51-b9c485096344', 'name_th' => 'หัวหน้าพนักงานบริการ', 'name_en' => 'test','default_financial'=>10000, 'checkLogin' => 'ไม่ล็อกอิน'],
            ['id' => '92075a3c-36b4-46d5-9d5e-1ad9ba183f88', 'ref_id' => '92075a3c-369d-47e7-9c51-b9c485096344', 'name_th' => 'พนักงานบริการ', 'name_en' => 'test','default_financial'=>10000, 'checkLogin' => 'ล็อกอิน'],
            ['id' => '92075a3c-36b9-4a63-9eb3-cb9e83b6e917', 'ref_id' => '92075a3c-36a2-4d0e-bcdc-b7e226269d87', 'name_th' => 'พนักงานบัญชี', 'name_en' => 'test','default_financial'=>10000, 'checkLogin' => 'ล็อกอิน'],
            ['id' => '92075a3c-36bd-4c3a-84ca-6422033a4cdc', 'ref_id' => '92075a3c-36a2-4d0e-bcdc-b7e226269d87', 'name_th' => 'พนักงานคลังสินค้า', 'name_en' => 'test','default_financial'=>10000, 'checkLogin' => 'ล็อกอิน'],
            ['id' => '92075a3c-36c2-4a46-b73e-b46684c378bf', 'ref_id' => '92075a3c-36a2-4d0e-bcdc-b7e226269d87', 'name_th' => 'พนักงานขายอะไหล่', 'name_en' => 'test','default_financial'=>10000, 'checkLogin' => 'ล็อกอิน'],
            ['id' => '92075a3c-36c6-4ff4-88c0-28f83b782ee8', 'ref_id' => '92075a3c-36a2-4d0e-bcdc-b7e226269d87', 'name_th' => 'พนักงานธุรการ', 'name_en' => 'Admin','default_financial'=>10000, 'checkLogin' => 'ล็อกอิน'],
        ];
        foreach($datas as $data){
            SettingMasterUser::create($data);
        }
    }
}
