<?php

namespace Database\Factories;


use App\Models\Customer;
use App\Models\Settings\SettingBasicBranch;
use App\Models\Settings\SettingMasterCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
           return [
            'code' => Str::random(10),
            'setting_master_customer_id' =>SettingMasterCustomer::whereNotBetween('name_th',['ตั้งค่าสมาชิก','ระดับสมาชิก','ลูกค้า','คู่ค้า','ประเภทข้อมูลติดต่อ'])->inRandomOrder()->first()->id,
            'customer_name' => $this->faker->name,
            'setting_basic_branch_id'=> SettingBasicBranch::all()->random()->id,
            'identification_number' => $this->faker->ean13,
            'tax_id'=>$this->faker->e164PhoneNumber
        ];
    }
}
