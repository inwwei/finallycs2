<?php

namespace Database\Factories\Settings;

use App\Models\Settings\SettingMasterUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingMasterUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SettingMasterUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $list = [
            'งานขาย' => 'test',
            'งานบริการ' => 'test',
            'งานออฟฟิศ' => 'test',
        ];
        $index = array_rand($list);

        return [
            'ref_id' => SettingMasterUser::inRandomOrder()->first() ?? null,
            'name_th' => $index,
            'name_en' => $list[$index],
            'default_financial' => $this->faker->randomNumber(2),
            'checkLogin' => $this->faker->randomElement(['ล็อกอิน', 'ไม่ล็อกอิน'])
        ];
    }
}
