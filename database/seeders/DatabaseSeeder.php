<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ChartsSeeder::class);
        $this->call(PlantSeeder::class);
        Artisan::call('iseki:demo_user');
        $this->call(CompaniesSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(BestPriceSeeder::class);


    }
}
