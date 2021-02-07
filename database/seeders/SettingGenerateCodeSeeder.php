<?php

namespace Database\Seeders;

use App\Models\Settings\SettingGenerateCode;
use Illuminate\Database\Seeder;

class SettingGenerateCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['id' => '101010-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบส่งของ(ผ่อน)','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'DO'],
            ['id' => '10101ๅ-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบวางบิล(ใบยอดคงเหลือ)','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'IV'],
            ['id' => '101012-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบเสร็จรับเงิน(ดาวน์)','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'RV'],
            ['id' => '101013-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบส่งของ(ไฟแนนซ์)','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'ST'],
            ['id' => '999999-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบสั่งซื้อ(รถ)','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'FO' ],
            ['id' => '888888-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบรายการสั่งซื้อ(อะไหล่)','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'RO' ],
            ['id' => '777777-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบเสร็จรับเงิน','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'S' ],
            ['id' => '666666-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบกำกับภาษี','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'S' ],
            ['id' => '555555-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบแจ้งหนี้','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'XX' ],
            ['id' => '444444-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบส่งของ','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'ST' ],
            ['id' => '333333-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบสำคัญจ่าย','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'XX' ],
            ['id' => '223333-A6B5-435F-997F-6B07D65C20B9','setting_basic_branch_id'=>'92418200-ed72-4d86-bfef-388d851ae071','name'=>'ใบขาย','pattern' => 'CODE-BRANCHYYMMRRRR', 'code' => 'SE' ],
    ];
    foreach($datas as $data){
        SettingGenerateCode::create($data);
    }
    }
}
