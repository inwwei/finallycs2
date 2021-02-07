<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $message = [], $errors = '0',  $status = 200) {
            return Response::json([
                'data' => $data,
                'message' => $message,
                'errors'  => $errors,
            ], $status);
        });

        Response::macro('error', function ($message = [], $errors = '1', $status = 400) {
            return Response::json([
                'data' => [],
                'message' => $message,
                'errors'  => $errors,
            ], $status);
        });
    }
    /**
     * ================ Error code ================
     * 0        ปกติ
     * 1        ผิดพลาด แต่แยกไม่ออกว่าจากระบบไหน
     * 2        จากการเข้าระบบ
     * 20       จากระบบ พนักงาน
     * 30       จากระบบ สมาชิก
     * 40       จากระบบ สินค้า
     * 50       จากระบบ บัญชี
     */
}
