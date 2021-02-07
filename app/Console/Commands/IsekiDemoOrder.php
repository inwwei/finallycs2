<?php

namespace App\Console\Commands;

use App\Models\Orders\Order;
use Illuminate\Console\Command;

class IsekiDemoOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_order';

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
        Order::factory()
        ->times(50)
        ->create();
    return 'success';
    }
}
