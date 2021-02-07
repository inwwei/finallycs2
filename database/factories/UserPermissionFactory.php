<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserPermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPermission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=> User::all()->random()->id,
            'user_permission' => $this->faker->userName,
            'remember_token' => Str::random(10),
        ];
    }
}
