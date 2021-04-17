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
        //    Product::where('id','0A7353F3-8433-468F-BB11-E4DAD0837401')->update(['question'=>'ข้าว']);

        $plants = Plant::get();
        $name = [];
        foreach ($plants as $index => $plant) {
            $plant['name'];
            $query_part = Product::where('status','ปกติ')
            ->where('name', $plant['name'])->max('price_per_kk');
            // return $query_part;
            $query_present = Product::where('status','ปกติ')
            ->where('name', $plant['name'])->where('price_per_kk',$query_part)->first();
            // $query_present['sum'] =    $query_present;
            BestPrice::create($query_present);
// return $query_present;
//             $result = [
//                 'query' => $query_present,
//                 'max' => $query_part,
//             ];

//             if (strlen($result['query'])>2) {
//                 array_push($name, $result);
//             }
        }
        })->everyMinute();
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
