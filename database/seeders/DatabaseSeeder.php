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
        $this->call(PlantsSeeder::class);
        Artisan::call('iseki:demo_user');



    }
}
