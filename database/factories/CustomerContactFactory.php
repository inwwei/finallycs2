<?php

namespace Database\Factories;

use App\Models\CustomerContact;
use App\Models\Customer;
use App\Models\Settings\SettingMasterContact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerContact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::all()->random()->id,
            'setting_master_contact_id' => SettingMasterContact::all()->random()->id,
            'value' => $this->faker->phoneNumber,
            'house_number' =>$this->faker->buildingNumber,
            'district' => $this->faker->citySuffix,
            'amphure' => $this->faker->city,
            'province' => $this->faker->cityPrefix,
            'postal_code' => $this->faker->postcode,
        ];
    }
}
