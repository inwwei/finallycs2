<?php

namespace Database\Factories\Settings;

use App\Models\Settings\SettingGenerateCode;
use App\Models\Model;
use App\Models\Settings\SettingBasicBranch;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingGenerateCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SettingGenerateCode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'setting_basic_branch_id' => SettingBasicBranch::all()->random()->id,
            'code' => 'test',
            'pattern' => 'CODE-BRANCHYYMMRRRR',
            'name' => 'test',
        ];
    }
}
