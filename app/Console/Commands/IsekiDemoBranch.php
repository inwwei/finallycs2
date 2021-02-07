<?php

namespace App\Console\Commands;

use App\Models\Settings\SettingBasicBranch;
use Illuminate\Console\Command;

class IsekiDemoBranch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_branch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        SettingBasicBranch::factory()->times(2)->create();
        return 'success';
    }
}
