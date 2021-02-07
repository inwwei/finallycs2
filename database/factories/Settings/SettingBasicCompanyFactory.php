<?php

namespace Database\Factories\Settings;

use App\Models\Settings\SettingBasicCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingBasicCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SettingBasicCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'tex_id' => $this->faker->ean13,
            'tel' => $this->faker->ean13,
            'house_number' => $this->faker->ean13,
            'district' => $this->faker->userName,
            'amphure' => $this->faker->userName,
            'province' => $this->faker->userName,
            'postal_code' => $this->faker->ean13,
        ];
    }
}
