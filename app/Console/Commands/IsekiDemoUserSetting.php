<?php

namespace App\Console\Commands;

use App\Models\Settings\SettingMasterUser;
use App\Models\UserSetting;
use Illuminate\Console\Command;

class IsekiDemoUserSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_usersetting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seedding data of usersetting';

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
        $this->info('Create user_permission data');
        SettingMasterUser::factory()
        ->times(2)
        ->create();
        return 'success';
    }
}
