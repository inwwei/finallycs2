<?php

namespace App\Http\Controllers;

use App\Models\Attached;
use App\Models\Log;

class TestController extends Controller
{
    public function testWeb()
    {
        $log = Log::first();

        $collection = collect($log->before_data);

        $diff = $collection->diffAssoc($log->after_data);

        $collection2 = collect($log->after_data);

        $diff2 = $collection2->diffAssoc($log->before_data);

        echo ($diff);
        echo ($diff2);
        // return storage_path('fonts/');
        // return view('base_pdf',[]);
        return Attached::get();
    }
    public function testJim()
    {
        return 'testJim';
    }

    public function testChart()
    {
        $data_array = [
            ['name' => 'มกราคม', 'value' => 100],
            ['name' => 'กุมภาพันธ์', 'value' => 150],
            ['name' => 'มีนาคม', 'value' => 80],
        ];
        return response()->success($data_array, [], '0', 200);
    }
}
