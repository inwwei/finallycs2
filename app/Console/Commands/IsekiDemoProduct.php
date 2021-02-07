<?php

namespace App\Console\Commands;

use App\Models\Product\Product;
use Illuminate\Console\Command;

class IsekiDemoProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding data of product';

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
        $this->info('Start Update member check');
        Product::factory()
        ->times(10)
        ->create();
        return 'success';
    }
}
