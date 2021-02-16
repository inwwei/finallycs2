<?php

namespace App\Console\Commands;

use App\Models\Settings\SettingMasterUser;
use App\Models\User;
use Illuminate\Console\Command;

class IsekiDemoUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seedding data of user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Create user data');

        // Fix user ตัวนี้ไว้จะได้จำ Login
        $data = User::create([
            'id'=>'92B2E648-AF2F-45DC-8FF0-F9E1058A3BC9',
            'identification_number'=>'1409600250281',
            'role'=>'member',
            'name' => 'จตุพล การเกษตร',
            'username' => 'test',
            'email' => 'test@iseki.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            "ceo_prefix"=> 'นาย',
            "ceo_firstname"=> 'จตุพล',
            "ceo_lastname"=> 'ดอนคูณ',
            "company_tel"=> '0973148164',
            "ceo_tel"=> '0973148164',
            "amphoe"=> 'เมือง',
            "district"=> 'ศิลา',
            "province"=> 'ขอนแก่น',
            "postal_code"=> '40000',
            "role"=> "member",
            "lat"=> 16.4736762,
            "lng"=> 102.8241283,
            "zoom"=>'18z',
            "name_location"=>'คณะวิทยาศาสตร์'
            ]);
        User::factory()
            ->times(50)
            ->create();

            $data = User::create([
                'role'=>'guest',
                'name' => 'guest',
                'username' => 'guest',
                'email' => 'guest@iseki.guest',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
                ]);
            User::factory()
                ->times(50)
                ->create();
    }
}
