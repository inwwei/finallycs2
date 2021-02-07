<?php

namespace Database\Seeders;

use App\Models\Settings\SettingDevice;
use App\Models\Settings\SettingMasterProduct;
use Illuminate\Database\Seeder;

class SettingDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name' => 'อุปกรณ์ทดสอบ', 'pin' => '1234'],
        ];

        foreach ($datas as $data) {
            SettingDevice::create($data);
        }
    }
}
