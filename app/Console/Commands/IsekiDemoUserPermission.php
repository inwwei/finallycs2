<?php

namespace App\Console\Commands;

use App\Models\UserPermission;
use Illuminate\Console\Command;

class IsekiDemoUserPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_userpermission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seedding data of userpermission';

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
        UserPermission::factory()
        ->times(50)
        ->create();
        return 'success';
    }
}
