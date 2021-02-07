<?php

namespace Database\Factories\Settings;

use App\Models\Settings\SettingMasterContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingMasterContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SettingMasterContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $list = [
            'ที่อยู่ตามทะเบียนบ้าน' => 'test',
            'เบอร์โทรศัพท์' => 'test',
            'อีเมล' => 'test'
        ];
        $index = array_rand($list);

        return [
            'ref_id' => SettingMasterContact::inRandomOrder()->first() ?? null,
            'name_th' => $index,
            'name_en' => $list[$index],
            'type' => $this->faker->randomElement(['หมวดหมู่', 'ที่อยู่', 'ทั่วไป'])
        ];
    }
}
