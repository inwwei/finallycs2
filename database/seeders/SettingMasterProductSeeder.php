<?php

namespace Database\Seeders;

use App\Models\Settings\SettingMasterProduct;
use Illuminate\Database\Seeder;

class SettingMasterProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [

            ['id' => '92073FE5-7122-4E95-8E20-565681D3ABAF','code' => '0000001', 'ref_id' => NULL, 'name_th' => 'หมวดหมู่/สินค้า', 'name_en' => 'Category/Product', 'retail_price' => '', 'type' => 'หมวดหมู่'],
            ['id' => '92073FE5-707C-4398-9AB4-481420EDB354','code' => '0000002', 'ref_id' => '92073FE5-7122-4E95-8E20-565681D3ABAF', 'name_th' => 'ตัวรถ', 'name_en' => 'car body', 'retail_price' => '', 'type' => 'ตัวรถ'],
            ['id' => '92073FE5-7083-4384-991B-56487E9C1BFC','code' => '0000003', 'ref_id' => '92073FE5-7122-4E95-8E20-565681D3ABAF', 'name_th' => 'อุปกรณ์ต่อพ่วง', 'name_en' => 'Peripheral device', 'retail_price' => '', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-7089-4719-BFC0-49DF29CE7DB4','code' => '0000004', 'ref_id' => '92073FE5-7122-4E95-8E20-565681D3ABAF', 'name_th' => 'อะไหล่', 'name_en' => 'spare parts', 'retail_price' => '', 'type' => 'อะไหล่'],
            ['id' => '92073FE5-7089-4719-BFC0-49DF29CE7DB5','code' => '0000005', 'ref_id' => '92073FE5-7089-4719-BFC0-49DF29CE7DB4', 'name_th' => 'น็อต', 'name_en' => 'nort', 'retail_price' => '12', 'type' => 'อะไหล่'],
            ['id' => '92073FE5-708E-4FD5-B577-F4B52FF6DC07','code' => '0000006', 'ref_id' => '92073FE5-707C-4398-9AB4-481420EDB354', 'name_th' => 'แทรกเตอร์', 'name_en' => 'TractorTractor', 'retail_price' => '', 'type' => 'ตัวรถ'],
            ['id' => '92073FE5-7094-4955-9201-55A8C51E9EDE','code' => '0000007', 'ref_id' => '92073FE5-707C-4398-9AB4-481420EDB354', 'name_th' => 'รถเกี่ยวข้าว', 'name_en' => 'Combine Harvester', 'retail_price' => '', 'type' => 'ตัวรถ'],
            ['id' => '92073FE5-7099-4C77-99D4-15DD2578E672','code' => '0000008', 'ref_id' => '92073FE5-708E-4FD5-B577-F4B52FF6DC07', 'name_th' => 'แทรกเตอร์ 40 แรง', 'name_en' => 'NT540', 'retail_price' => '501000', 'type' => 'ตัวรถ'],
            ['id' => '92073FE5-709F-4B49-8B2F-7131B35126BA','code' => '0000009', 'ref_id' => '92073FE5-708E-4FD5-B577-F4B52FF6DC07', 'name_th' => 'แทรกเตอร์ 42 แรง', 'name_en' => 'NT542', 'retail_price' => '505000', 'type' => 'ตัวรถ'],
            ['id' => '92073FE5-70A4-45B7-9EAF-766266566737','code' => '0000010', 'ref_id' => '92073FE5-708E-4FD5-B577-F4B52FF6DC07', 'name_th' => 'แทรกเตอร์ 54 แรง', 'name_en' => 'NT554', 'retail_price' => '509000', 'type' => 'ตัวรถ'],
            ['id' => '92073FE5-70A9-4F90-B120-F97AFC66D4AF','code' => '0000011', 'ref_id' => '92073FE5-7083-4384-991B-56487E9C1BFC', 'name_th' => 'ผานพรวน', 'name_en' => 'Phan Phuan', 'retail_price' => '', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70B9-4DB4-A314-4EE9CF3EF342','code' => '0000012', 'ref_id' => '92073FE5-7083-4384-991B-56487E9C1BFC', 'name_th' => 'ผานบุกเบิก', 'name_en' => 'Pioneer', 'retail_price' => '', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70BE-4683-AE7A-6C33D6027035','code' => '0000013', 'ref_id' => '92073FE5-7083-4384-991B-56487E9C1BFC', 'name_th' => 'โรตารี่', 'name_en' => 'Rotary', 'retail_price' => '', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70C4-4554-9C44-002FCA81FC16','code' => '0000014', 'ref_id' => '92073FE5-7083-4384-991B-56487E9C1BFC', 'name_th' => 'บุ้งกี้', 'name_en' => 'Buckets', 'retail_price' => '', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70CA-41EC-978E-14ABCF511289','code' => '0000015', 'ref_id' => '92073FE5-7083-4384-991B-56487E9C1BFC', 'name_th' => 'ใบดัน', 'name_en' => 'Push leaf', 'retail_price' => '', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70CF-41A9-926D-BE8AED67D22B','code' => '0000016', 'ref_id' => '92073FE5-70A9-4F90-B120-F97AFC66D4AF', 'name_th' => 'ผานพรวน 22 นิ้ว 5 ใบ', 'name_en' => 'DH225', 'retail_price' => '36100', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70D4-4242-9ECA-5B046D02C974','code' => '0000017', 'ref_id' => '92073FE5-70A9-4F90-B120-F97AFC66D4AF', 'name_th' => 'ผานพรวน 22 นิ้ว 6 ใบ', 'name_en' => 'DH226', 'retail_price' => '46100', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70D9-4AC9-A822-02472F02454B','code' => '0000018', 'ref_id' => '92073FE5-70A9-4F90-B120-F97AFC66D4AF', 'name_th' => 'ผานพรวน 24 นิ้ว 5 ใบ', 'name_en' => 'DH245', 'retail_price' => '56100', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70DE-4AAA-AA96-573B0CBCDD6D','code' => '0000019', 'ref_id' => '92073FE5-70A9-4F90-B120-F97AFC66D4AF', 'name_th' => 'ผานพรวน 24 นิ้ว 6 ใบ', 'name_en' => 'DH246', 'retail_price' => '66100', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70E3-4F46-AC89-8CD507A9F5F0','code' => '0000020', 'ref_id' => '92073FE5-70B9-4DB4-A314-4EE9CF3EF342', 'name_th' => 'ผานบุกเบิก 22 นิ้ว 3 ใบ', 'name_en' => 'DP223', 'retail_price' => '36400', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70EE-4670-AB59-B47E7EF7582F','code' => '0000021', 'ref_id' => '92073FE5-70B9-4DB4-A314-4EE9CF3EF342', 'name_th' => 'ผานบุกเบิก 22 นิ้ว 4 ใบ', 'name_en' => 'DP224', 'retail_price' => '39400', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70F5-44C1-9EAC-8FA4A6E07353','code' => '0000022', 'ref_id' => '92073FE5-70B9-4DB4-A314-4EE9CF3EF342', 'name_th' => 'ผานบุกเบิก 24 นิ้ว 3 ใบ', 'name_en' => 'IST-SDP243', 'retail_price' => '49500', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70FA-4E5E-823D-F85A4F3230EB','code' => '0000023', 'ref_id' => '92073FE5-70B9-4DB4-A314-4EE9CF3EF342', 'name_th' => 'ผานบุกเบิก 24 นิ้ว 3 ใบ', 'name_en' => 'IST-SDP244', 'retail_price' => '59500', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-70FF-40F6-8535-EC9D1411B9D6','code' => '0000024', 'ref_id' => '92073FE5-70BE-4683-AE7A-6C33D6027035', 'name_th' => 'โรตารี่ 172 เซนติเมตร', 'name_en' => 'RT172', 'retail_price' => '60000', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-7104-45B8-89A8-0525A1682EBF','code' => '0000025', 'ref_id' => '92073FE5-70BE-4683-AE7A-6C33D6027035', 'name_th' => 'โรตารี่ 200 เซนติเมตร', 'name_en' => 'RT200', 'retail_price' => '90000', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-7109-4F9F-B651-C2D92CEBD245','code' => '0000026', 'ref_id' => '92073FE5-70C4-4554-9C44-002FCA81FC16', 'name_th' => 'บุ้งกี้ รถ 40 แรง', 'name_en' => 'FLN450', 'retail_price' => '182500', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-710E-4A0C-9650-7429917CD2B6','code' => '0000027', 'ref_id' => '92073FE5-70C4-4554-9C44-002FCA81FC16', 'name_th' => 'บุ้งกี้ รถ 54 แรง', 'name_en' => 'FLN500', 'retail_price' => '192501', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-7114-4512-9DAD-CDD60230E452','code' => '0000028', 'ref_id' => '92073FE5-70CA-41EC-978E-14ABCF511289', 'name_th' => 'ใบดันรถ 40 แรง', 'name_en' => 'FBN165', 'retail_price' => '49000', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-7119-4F57-B823-CE4023FFAC69','code' => '0000029', 'ref_id' => '92073FE5-70CA-41EC-978E-14ABCF511289', 'name_th' => 'ใบดันรถ 42 แรง', 'name_en' => 'FBN160', 'retail_price' => '59000', 'type' => 'ต่อพ่วง'],
            ['id' => '92073FE5-711E-4A73-BDE1-B5A38B651A01','code' => '0000030', 'ref_id' => '92073FE5-70CA-41EC-978E-14ABCF511289', 'name_th' => 'ใบดันรถ 54 แรง', 'name_en' => 'FBN180', 'retail_price' => '69000', 'type' => 'ต่อพ่วง'],
            ['id' => '920754B4-F0E2-4CF9-ACEC-5A32581C3F91','code' => '0000031', 'ref_id' => '92073FE5-7094-4955-9201-55A8C51E9EDE', 'name_th' => 'รถเกี่ยวข้าว 80 แรง', 'name_en' => 'HC80P', 'retail_price' => '1509000', 'type' => 'ตัวรถ'],
            ['id' => '920754B4-F0E8-4035-AA93-7297CB465AB5','code' => '0000032', 'ref_id' => '92073FE5-7094-4955-9201-55A8C51E9EDE', 'name_th' => 'รถเกี่ยวข้าว 80 แรง พลัส', 'name_en' => 'HC80P+', 'retail_price' => '1609000', 'type' => 'ตัวรถ'],

        ];

        foreach ($datas as $data) {
            SettingMasterProduct::create($data);
        }
    }
}
