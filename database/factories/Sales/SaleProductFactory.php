<?php

namespace Database\Factories\Sales;

use App\Models\Customer;
use App\Models\Model;
use App\Models\Sales\SaleProduct;
use App\Models\Settings\SettingMasterCustomer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class SaleProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seller_id' => Auth::user()->id,
            'customer_id' => Customer::all()->random()->id,
            'date' => new Carbon()
        ];
    }
}
