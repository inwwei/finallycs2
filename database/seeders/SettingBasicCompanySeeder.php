<?php

namespace Database\Seeders;

use App\Models\Settings\SettingBasicCompany;
use Illuminate\Database\Seeder;

class SettingBasicCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['id' => '924383F5-8588-44DE-81DB-DAF6653A2A04', 'name' => 'ISEKI H.Thai', 'tex_id' => '0-4455-59000-82-1', 'tel' => '090 280 3939', 'house_number' => '151 M.2', 'district' => 'Lan Sakae', 'amphure' => 'Phayakkhaphum Phisai', 'province' => 'Maha Sarakham', 'postal_code' => '44110']
        ];

        foreach ($datas as $data) {
            SettingBasicCompany::create($data);
        }
    }
}
