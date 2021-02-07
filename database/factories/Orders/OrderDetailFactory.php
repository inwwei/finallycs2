<?php

namespace Database\Factories\Orders;

use App\Models\Orders\Order;
use App\Models\Orders\OrderDetail;
use App\Models\Product\Product;
use App\Models\Settings\SettingMasterProduct;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $amount_index = $this->faker->numberBetween($min = 1, $max = 19 );

        $wholesale_price_index = $this->faker->numberBetween($min = 10000, $max = 90000 );
        return [
            'order_id' => Order::all()->random()->id,
            'setting_master_product_id' => SettingMasterProduct::all()->random()->id,
            'amount'=>$amount_index,
            'type' =>$this->faker->randomElement($array = array ('สั่ง')) ,
            'wholesale_price'=>$wholesale_price_index,
            'total_price'=>$amount_index * $wholesale_price_index,
        ];
    }
}
