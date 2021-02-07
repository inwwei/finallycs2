<?php

namespace Database\Factories\Sales;

use App\Models\Model;
use App\Models\Product\Product;
use App\Models\Sales\SaleProduct;
use App\Models\Sales\SaleProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleProductDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleProductDetail::class;

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
            'sell_id' => SaleProduct::all()->random()->id,
            'product_id' => Product::all()->random()->id,
            'amount'=>$amount_index,
            'wholesale_price'=>$wholesale_price_index,
            'total_price'=>$amount_index * $wholesale_price_index,
        ];
    }
}
