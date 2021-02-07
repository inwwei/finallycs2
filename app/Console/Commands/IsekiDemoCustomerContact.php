<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CustomerContact;

class IsekiDemoCustomerContact extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_customer_contact';

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
        CustomerContact::factory()
            ->times(50)
            ->create();
        return 'success';
    }
}
