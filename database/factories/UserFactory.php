<?php

namespace Database\Factories;

use App\Models\Settings\SettingBasicBranch;
use App\Models\Settings\SettingMasterUser;
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
            'code' => $this->faker->ean13,
            'setting_master_users_id' => SettingMasterUser::all()->whereNotNull('ref_id')->random()->id,
            'financial' => 10000,
            'branch_id' => SettingBasicBranch::all()->random()->id,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
