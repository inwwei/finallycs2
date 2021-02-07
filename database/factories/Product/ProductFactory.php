<?php

namespace Database\Factories\Product;

use App\Models\Product\Product;
use App\Models\Settings\SettingBasicBranch;
use App\Models\Settings\SettingMasterProduct;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

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
            'setting_master_product_id' => SettingMasterProduct::first()->id,
            'setting_basic_branch_id' => SettingBasicBranch::first()->id,
            'vin' => $this->faker->regexify('[A]+[0-9]+[A-Z]'),
            'description' => $this->faker->randomElement($array = array('รุ่นเก่า', 'รุ่นใหม่', 'รุ่นพิเศษ')),
            'quantity' => $this->faker->randomDigit,
            'retail_price' => $this->faker->randomDigit,
            'wholesale_price' => $this->faker->randomDigit,
        ];
    }

    public function settingMasterProductTypeParts()
    {
        return $this->state(function (array $instance) {
            $settingID = SettingMasterProduct::where('type','อะไหล่')->first()->id;
            return [
                'setting_master_product_id' => $settingID,
            ];
        });
    }

    public function settingMasterProductTypeNotParts()
    {
        return $this->state(function (array $instance) {
            $settingID = SettingMasterProduct::where('type','!=','อะไหล่')->first()->id;
            return [
                'setting_master_product_id' => $settingID,
            ];
        });
    }
}
