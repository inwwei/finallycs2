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
                ['id' => '92AC9BA3-2BFE-4B48-94C3-F91D051F94C9','plant_id'=>'92B2E648-B34C-44BB-8E55-BA495C7F89CF','company_id'=>'933F1F57-F174-4294-BD01-731B0F7DD2F7', 'name'=>'ข้าวหอมมะลิ','question' => 'ราคามันสำปะหลังที่ดีที่สุด', 'price_per_kk' => 11.5, 'price_per_ton' => 11500, 'name_location' => 'ขอนแก่น','lat'=>7.0234567,'lng'=>7.0234567],
                ['id' => '92AC9BA3-2C07-4EF1-A5B5-422A644EE979','plant_id'=>'92B2E648-AF2F-45DC-8FF0-F9E1058A3BCF','company_id'=>'933F1F57-F156-4FF2-B9E1-880DE3141699', 'name'=>'ผักคะน้า คละ','question' => 'ราคาข้าวเปลือกเจ้าดีที่สุด', 'price_per_kk' => 15, 'price_per_ton' => 15000,  'name_location' => 'ขอนแก่น','lat'=>7.0234567,'lng'=>7.0234567],
                ['id' => '92AC9BA3-2C0D-4AE1-B9DB-1C1524216E99','plant_id'=>'92B2E648-AF34-43F2-AD37-1DB76DF90C68','company_id'=>'933F1F57-F156-4FF2-B9E1-880DE3141699', 'name'=>'ผักคะน้า คัด','question' => 'ราคาข้าวเปลือกเจ้าโรงสีข้าวแหลมทอง', 'price_per_kk' => 16, 'price_per_ton' => 16000,  'name_location' => 'ขอนแก่น','lat'=>7.0234567,'lng'=>7.0234567],
                ];
    foreach($datas as $data){
        BestPrice::create($data);
    }
    }
}
