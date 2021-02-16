<?php

namespace Database\Seeders;

use App\Models\BestPrice;
use App\Models\Charts;
use Illuminate\Database\Seeder;

class BestPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
                ['id' => '92AC9BA3-33DC-495D-B314-498939C1DE39', 'name'=>'อ้อย','question' => 'ราคาอ้อยที่ดีที่สุด', 'price_per_kk' => 18, 'price_per_ton' => 18000, 'company' => 'มข การเกษตร', 'location' => '321 ม.0 ต.นอกเมือง อ.นอกเมือง จ.ขอนแก่น'],
                ['id' => '92AC9BA3-2BFE-4B48-94C3-F91D051F94C9', 'name'=>'มันสำปะหลัง','question' => 'ราคามันสำปะหลังที่ดีที่สุด', 'price_per_kk' => 11.5, 'price_per_ton' => 11500, 'company' => 'ชุมแพการเกษตร', 'location' => '123 ม.1 ต.ในเมือง อ.เมือง จ.ขอนแก่น 40000'],
                ['id' => '92AC9BA3-2C07-4EF1-A5B5-422A644EE979', 'name'=>'ข้าวเปลือกเจ้า','question' => 'ราคาข้าวเปลือกเจ้าดีที่สุด', 'price_per_kk' => 15, 'price_per_ton' => 15000, 'company' => 'บริษัท โรงสีข้าวแหลมทอง (1995) จำกัด', 'location' => '123 ม.1 ต.ในเมือง อ.เมือง จ.ขอนแก่น 40000'],
                ['id' => '92AC9BA3-2C0D-4AE1-B9DB-1C1524216E99', 'name'=>'ข้าวเปลือกเจ้าโรงสีข้าวแหลมทอง','question' => 'ราคาข้าวเปลือกเจ้าโรงสีข้าวแหลมทอง', 'price_per_kk' => 16, 'price_per_ton' => 16000, 'company' => 'บริษัท โรงสีข้าวแหลมทอง (1995) จำกัด', 'location' => '333 หมู่ 3 ถนน มะลิวัลย์ ต.บ้านเป็ด อำเภอเมืองขอนแก่น ขอนแก่น 40000 ไทย'],
                ];
    foreach($datas as $data){
        BestPrice::create($data);
    }
    }
}
