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
            'code' => 'T0001',
            'name' => 'Mr.JIMMY',
            'username' => 'test',
            'setting_master_users_id' => SettingMasterUser::all()->whereNotNull('ref_id')->random()->id,
            'branch_id' => '92418200-ed72-4d86-bfef-388d851ae071',
            'email' => 'test@iseki.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        User::factory()
            ->times(50)
            ->create();
    }
}
