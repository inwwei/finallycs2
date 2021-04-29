<?php

namespace Database\Seeders;

use App\Models\Charts;
use App\Models\Company;
use App\Models\Plant;
use App\Models\Product\Product;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
                 ['id' => '933F1F57-F156-4FF2-B9E1-880DE3141699', 'user_id' => '92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9', 'identification_number' => '', 'name' => 'CS การเกษตร สาขา 1', 'branch' => '1', 'email' => 'weihei@gail.com', 'ceo_firstname' => 'จตุพล', 'ceo_lastname' => 'ดอนคูณ', 'company_tel' => '09731458164', 'ceo_tel' => '09731458164', 'amphoe' => 'ศิลา', 'district' => 'เมือง', 'province' => 'ขอนแก่น', 'postal_code' => '40000', 'name_location' => 'คณะวิทยาศาสตร์+มหาวิทยาลัยขอนแก่น', 'lat' => 16.4753864, 'lng' => 102.8243166, 'zoom' => '18z'],
                 ['id' => '933F1F57-F156-4FF2-B9E1-1B0DE31416D2', 'user_id' => '92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9', 'identification_number' => '', 'name' => 'CS การเกษตร สาขา 2', 'branch' => '2', 'email' => 'weihei@gail.com', 'ceo_firstname' => 'จตุพล', 'ceo_lastname' => 'ดอนคูณ', 'company_tel' => '09731458164', 'ceo_tel' => '09731458164', 'amphoe' => 'ศิลา', 'district' => 'เมือง', 'province' => 'ขอนแก่น', 'postal_code' => '40000', 'name_location' => 'คณะวิทยาศาสตร์+มหาวิทยาลัยขอนแก่น', 'lat' => 16.4753864, 'lng' => 102.8243166, 'zoom' => '18z'],
                 ['id' => '933F1F57-F15E-4542-BD30-A1304FA8B3F7', 'user_id' => '92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9', 'identification_number' => '', 'name' => 'CS การเกษตร สาขา 3', 'branch' => '3', 'email' => 'weihei@gail.com', 'ceo_firstname' => 'จตุพล', 'ceo_lastname' => 'ดอนคูณ', 'company_tel' => '09731458164', 'ceo_tel' => '09731458164', 'amphoe' => 'ศิลา', 'district' => 'เมือง', 'province' => 'ขอนแก่น', 'postal_code' => '40000', 'name_location' => 'คณะวิทยาศาสตร์+มหาวิทยาลัยขอนแก่น', 'lat' => 16.4753864, 'lng' => 102.8243166, 'zoom' => '18z'],
                 ['id' => '933F1F57-F164-4077-B57F-032BA4AB65DB', 'user_id' => '92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9', 'identification_number' => '', 'name' => 'โรงสีข้าวดลทรัพย์', 'branch' => '1', 'email' => 'weihei@gail.com', 'ceo_firstname' => 'จตุพล', 'ceo_lastname' => 'ดอนคูณ', 'company_tel' => '09731458164', 'ceo_tel' => '09731458164', 'amphoe' => 'ยางน้อย', 'district' => 'โกสุมพิสัย', 'province' => 'มหาสารคาม', 'postal_code' => '44140', 'name_location' => 'โรงสีข้าวดลทรัพย์', 'lat' => 16.3090418, 'lng' => 102.8208145, 'zoom' => '10z'],
                 ['id' => '933F1F57-F168-4AD1-B5E4-0E4E5991263C', 'user_id' => '92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9', 'identification_number' => '', 'name' => 'บริษัท โรงสีข้าวแหลมทอง', 'branch' => '5', 'email' => 'weihei@gail.com', 'ceo_firstname' => 'จตุพล', 'ceo_lastname' => 'ดอนคูณ', 'company_tel' => '09731458164', 'ceo_tel' => '09731458164', 'amphoe' => 'บ้านเป็ด', 'district' => 'เมืองขอนแก่น', 'province' => 'ขอนแก่น', 'postal_code' => '40220', 'name_location' => 'บริษัท+โรงสีข้าวแหลมทอง+(1995)+จำกัด', 'lat' => 16.4474064, 'lng' => 102.7581721, 'zoom' => '17z'],
                 ['id' => '933F1F57-F16C-44CE-BE85-57A72147F861', 'user_id' => '92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9', 'identification_number' => '', 'name' => 'CS การเกษตร สาขา 6', 'branch' => '6', 'email' => 'weihei@gail.com', 'ceo_firstname' => 'จตุพล', 'ceo_lastname' => 'ดอนคูณ', 'company_tel' => '09731458164', 'ceo_tel' => '09731458164', 'amphoe' => 'สีชมพู', 'district' => 'สีชมพู', 'province' => 'ขอนแก่น', 'postal_code' => '40220', 'name_location' => 'โรงเรียนสีชมพูศึกษา', 'lat' => 16.8009369, 'lng' => 102.1881896, 'zoom' => '17.25z'],
                 ['id' => '933F1F57-F170-4021-A044-870506050863', 'user_id' => '92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9', 'identification_number' => '', 'name' => 'CS การเกษตร สาขา 7', 'branch' => '7', 'email' => 'weihei@gail.com', 'ceo_firstname' => 'จตุพล', 'ceo_lastname' => 'ดอนคูณ', 'company_tel' => '09731458164', 'ceo_tel' => '09731458164', 'amphoe' => 'สีชมพู', 'district' => 'สีชมพู', 'province' => 'ขอนแก่น', 'postal_code' => '40220', 'name_location' => 'โรงเรียนสีชมพูศึกษา', 'lat' => 16.8009369, 'lng' => 102.1881896, 'zoom' => '17.25z'],
                 ['id' => '933F1F57-F174-4294-BD01-731B0F7DD2F7', 'user_id' => '92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9', 'identification_number' => '', 'name' => 'CS การเกษตร สาขา 8', 'branch' => '8', 'email' => 'weihei@gail.com', 'ceo_firstname' => 'จตุพล', 'ceo_lastname' => 'ดอนคูณ', 'company_tel' => '09731458164', 'ceo_tel' => '09731458164', 'amphoe' => 'สีชมพู', 'district' => 'สีชมพู', 'province' => 'ขอนแก่น', 'postal_code' => '40220', 'name_location' => 'โรงเรียนสีชมพูศึกษา', 'lat' => 16.8009369, 'lng' => 102.1881896, 'zoom' => '17.25z'],

        ];
    foreach($datas as $data){
        Company::create($data);
    }
    }
}
