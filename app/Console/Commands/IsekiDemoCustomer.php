<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;

class IsekiDemoCustomer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_customer';

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
        Customer::factory()
            ->times(20)
            ->create();
        return 'success';
    }
}
