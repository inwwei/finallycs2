<?php

namespace App\Console;

use App\Models\BestPrice;
use App\Models\Plant;
use App\Models\Product\Product;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\AutoInsert::class,
        // Commands\IsekiDemoAutoInsertProduct::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('csc2:auto_insert')->everyMinute();
        $schedule->call(function () {
            $plants = Plant::get();

            $name = [];
            foreach ($plants as $index => $plant) {
                $plant['name'];
                $query_part = Product::where('status', 'ปกติ')
                    ->where('name', $plant['name'])->max('price_per_kk');
                $query_present = Product::where('status', 'ปกติ')
                    ->where('name', $plant['name'])->where('price_per_kk', $query_part)->first();
                // BestPrice::create($query_present);

                if (isset($query_present)) {

                    $result = [
                        'company_id' => $query_present->company_id,
                        'plant_id' => $query_present->plant_id,
                        'name' => $query_present->name,
                        'lat' => null,
                        'lng' => null,
                        'price_per_kk' => $query_present->price_per_kk,
                    ];

                    array_push($name, $result);
                }
            }

    foreach ($name as $key => $datas) {
        BestPrice::create($datas);
    }

        })->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
