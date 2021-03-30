<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Http;
use App\Models\Settings\SettingMasterUser;
use App\Models\User;
use Illuminate\Console\Command;

class AutoInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csc2:auto_insert';

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
        $this->info('Start GET API TO MinistryOfCommerceInformation');
        $response = Http::get('https://dataapi.moc.go.th/gis-product-prices?product_id=P11001&from_date=2021-03-03&to_date=2021-03-26');
            dd($response);
            $this->info($response);
    }
}
