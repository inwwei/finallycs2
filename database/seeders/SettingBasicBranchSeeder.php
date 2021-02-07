<?php

namespace Database\Seeders;

use App\Models\Settings\SettingBasicBranch;
use Illuminate\Database\Seeder;

class SettingBasicBranchSeeder extends Seeder
{
      /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
                ['id' => '92418200-ED72-4D86-BFEF-388D851AE071', 'branch_name' => 'สาขาพยัคฆ์ฯ', 'branch_code' => '01','company_id' => '924383F5-8588-44DE-81DB-DAF6653A2A04'],
                ['id' => '92418200-ED7E-4902-8005-FEAAFDC905E8', 'branch_name' => 'สาขาโกสุมพิสัย', 'branch_code' => '02','company_id' => '924383F5-8588-44DE-81DB-DAF6653A2A04'],
        ];
        foreach($datas as $data){
            SettingBasicBranch::create($data);
        }
    }
}
