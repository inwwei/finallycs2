<?php

namespace Database\Factories\Orders;

use App\Models\Orders\Order;
use App\Models\Customer;
use App\Models\Settings\SettingBasicBranch;
use App\Models\Settings\SettingMasterCustomer;
use App\Models\Settings\SettingMasterProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $setting_master_product_id = SettingMasterProduct::all()->random()->id;
        $count = Order::where('setting_master_product_id',$setting_master_product_id)->count()+1;
        $number= str_pad($count, 4, "0", STR_PAD_LEFT);
        $get_branch = SettingBasicBranch::where('branch_code','01')->first();
        $branch = $get_branch->branch_code;
        $date = Carbon::now()->add(543, 'year')->isoFormat('YYMM');
        $code = 'RO'.'-'.$branch.$date.$number;
        return [
            'partner_id' => SettingMasterCustomer::all()->where('ref_id','6F8F8778-3EDD-4D1C-8FDC-F9FF585BA69F')->random()->id,
            'user_id' => '12CAC0F0-8799-4759-A356-EE3216D0378C',
            'code' =>$code,
            'setting_master_product_id' => $setting_master_product_id,
            'code_ref' => Str::random(10),
            'total_price'=>$this->faker->numberBetween(5000,6000),
            'type' =>$this->faker->randomElement($array = array ('ประจำเดือน','เร่งด่วน')) ,
            'status' =>$this->faker->randomElement($array = array ('ร่าง','รอยืนยัน','ยืนยัน','ยกเลิก')) ,
            'print' =>$this->faker->randomElement($array = array ('ไม่สำเร็จ')) ,
        ];
    }
}
