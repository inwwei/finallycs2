<?php

namespace Database\Factories;

use App\Models\Settings\SettingMasterContact;
use App\Models\User;
use App\Models\UserContact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'setting_master_contact_id' => SettingMasterContact::all()->whereNotNull('ref_id')->random()->id,
            'value' => $this->faker->phoneNumber,
            'house_number' =>$this->faker->buildingNumber,
            'district' => $this->faker->citySuffix,
            'amphure' => $this->faker->city,
            'province' => $this->faker->cityPrefix,
            'postal_code' => $this->faker->postcode,
        ];
    }
}
