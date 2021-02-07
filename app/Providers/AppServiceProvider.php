<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * เพิ่มความสามารถของ Blueprint ให้ตอน Migrate
         * มีโครงสร้างใหม่
         *      timestampsBy, softDeletesBy
         */
        Blueprint::macro('timestampsBy', function () {
            $this->uuid('created_by')->nullable();
            $this->uuid('updated_by')->nullable();
        });
        Blueprint::macro('softDeletesBy', function () {
            $this->uuid('deleted_by')->nullable();
        });


    }
}
