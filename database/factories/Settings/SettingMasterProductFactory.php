<?php

namespace Database\Factories\Settings;

use App\Models\Settings\SettingMasterProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingMasterProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SettingMasterProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $list = [
            'รถเกี่ยวนวดข้าว' => 'Combine harvester',
            'อุปกรณ์ต่อเสริม' => 'Optional accessories',
            'ล้อ' => 'wheel'
        ];
        $index = array_rand($list);

        return [
            'ref_id' => SettingMasterProduct::inRandomOrder()->first() ?? null,
            'name_th' => $index,
            'name_en' => $list[$index],
            'retail_price' => $this->faker->randomNumber(),
            'type' => $this->faker->randomElement(['หมวดหมู่', 'ตัวรถ', 'อะไหล่', 'ต่อพ่วง'])
        ];

    }
}
