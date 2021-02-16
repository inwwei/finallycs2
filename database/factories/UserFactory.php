<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'identification_number' => $this->faker->ean13,
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'ceo_prefix' => 'Mr.',
            'ceo_firstname' => $this->faker->firstNameFemale,
            'ceo_lastname' => $this->faker->lastName,
            'company_tel' => $this->faker->e164PhoneNumber,
            'ceo_tel' => $this->faker->e164PhoneNumber,
            'amphoe' => $this->faker->company,
            'district' => $this->faker->company,
            'province' => $this->faker->company,
            'role'=>'member',
            'postal_code' => '40220',
            'latitude' => $this->faker->latitude($min = -90, $max = 90),
            'longtitude' => $this->faker->longitude($min = -180, $max = 180),
            'remember_token' => Str::random(10),
        ];
    }
}
