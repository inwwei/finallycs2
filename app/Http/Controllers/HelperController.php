<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    // FIXME: ต้องไปดึง Tag จากระบบอื่นๆ เช่น สินค้า มาทำ
    public function allTag()
    {
        $data = [
            ['text' => 'Spain',],
            ['text' => 'France',],
            ['text' => 'USA',],
            ['text' => 'Germany',],
            ['text' => 'China',]
        ];

        if (!$data) {
            return response()->error(['ไม่มีข้อมูลในระบบ'], '40');
        } else {
            return response()->success($data, [], '0', 200);
        }
    }
}
