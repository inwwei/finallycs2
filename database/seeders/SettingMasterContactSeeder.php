<?php

namespace Database\Seeders;

use App\Models\Settings\SettingMasterContact;
use Illuminate\Database\Seeder;

class SettingMasterContactSeeder extends Seeder
{
      /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
                ['id' => '920AFDE1-A6B5-435F-997F-6B07D65C20B9', 'ref_id' => null, 'name_th' => 'หมวดการติดต่อ', 'name_en' => 'test', 'type' => ''],
                ['id' => '920AFDE1-A6BD-4EC0-BF26-3EB6A4C7FA2E', 'ref_id' => '920AFDE1-A6B5-435F-997F-6B07D65C20B9', 'name_th' => 'หมวดที่อยู่', 'name_en' => 'test', 'type' => 'ที่อยู่'],
                ['id' => '920AFDE1-A6C8-43BD-9E9A-68EBDB2AC919', 'ref_id' => '920AFDE1-A6BD-4EC0-BF26-3EB6A4C7FA2E', 'name_th' => 'ที่อยู่ตามทะเบียนบ้าน', 'name_en' => 'test', 'type' => 'ที่อยู่'],
                ['id' => '920AFDE1-A6CD-47F6-9CD5-216A5DECCC8D', 'ref_id' => '920AFDE1-A6BD-4EC0-BF26-3EB6A4C7FA2E', 'name_th' => 'ที่อยู่ปัจจุบัน', 'name_en' => 'test', 'type' => 'ที่อยู่'],
                ['id' => '920AFDE1-A6C3-4C17-9CE4-7F2841FBE7AD', 'ref_id' => '920AFDE1-A6B5-435F-997F-6B07D65C20B9', 'name_th' => 'หมวดทั่วไป', 'name_en' => 'test', 'type' => 'ทั่วไป'],
                ['id' => '920AFDE1-A6E8-4869-BB3A-BD1CB41675CD', 'ref_id' => '920AFDE1-A6C3-4C17-9CE4-7F2841FBE7AD', 'name_th' => 'เบอร์โทรศัพท์', 'name_en' => 'test', 'type' => 'ทั่วไป'],
                ['id' => '920AFDE1-A6EE-4738-ABE4-47B4B239F1EC', 'ref_id' => '920AFDE1-A6C3-4C17-9CE4-7F2841FBE7AD', 'name_th' => 'อีเมล', 'name_en' => 'test', 'type' => 'ทั่วไป'],
        ];
        foreach($datas as $data){
            SettingMasterContact::create($data);
        }
    }
}
