<?php

namespace App\Console\Commands;

use App\Models\Product\Product;
use App\Models\Product\ProductLog;
use Illuminate\Console\Command;

class IsekiDemoAutoInsertProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseki:demo_insertProductAuto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insertProductAuto';

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
        $this->info('Start insert product for create report product');
        $products = Product::get();
        foreach($products as $product){
            $data = [
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'sell_out' => $product['sell_out'],
                'admit' => $product['admit'],
            ];
            ProductLog::create($data);
        }
        $this->info($product);
        return 'success';
    }
}
