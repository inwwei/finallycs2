<?php

namespace App\Console\Commands;

use App\Models\Settings\SettingBasicCompany;
use Illuminate\Console\Command;

class IsekiDemoCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seeding company data';

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
        SettingBasicCompany::factory()->create();
        return 'success';
    }
}
