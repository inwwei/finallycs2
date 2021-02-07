<?php

namespace Database\Factories\Settings;

use App\Models\Settings\SettingBasicBranch;
use App\Models\Settings\SettingBasicCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingBasicBranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SettingBasicBranch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'branch_name' => 'test',
            'branch_code' => 'test',
            'company_id' => SettingBasicCompany::all()->random()->id
        ];
    }
}
