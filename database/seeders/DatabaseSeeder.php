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
        // \App\Models\User::factory(10)->create();

        $this->call(SettingBasicCompanySeeder::class);
        $this->call(SettingBasicBranchSeeder::class);
        $this->call(SettingDeviceSeeder::class);
        $this->call(SettingMasterCustomerSeeder::class);
        $this->call(SettingMasterContactSeeder::class);
        $this->call(SettingMasterProductSeeder::class);
        $this->call(SettingMasterUserSeeder::class);
        $this->call(SettingGenerateCodeSeeder::class);
        Artisan::call('iseki:demo_user');
        Artisan::call('iseki:demo_product');
        Artisan::call('iseki:demo_customer');
        Artisan::call('iseki:demo_customer_contact');


    }
}
