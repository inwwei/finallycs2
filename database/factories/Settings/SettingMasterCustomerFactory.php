<?php

namespace Database\Factories\Settings;

use App\Models\Settings\SettingMasterCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingMasterCustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SettingMasterCustomer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $list = [
            'ปกติ' => 'Normal',
            'พิเศษ' => 'Vip',
            'สุดพิเศษ' => 'SVip'
        ];
        $index = array_rand($list);

        return [
            'ref_id' => SettingMasterCustomer::inRandomOrder()->first() ?? null,
            'name_th' => $index,
            'name_en' => $list[$index],
        ];
    }
}
