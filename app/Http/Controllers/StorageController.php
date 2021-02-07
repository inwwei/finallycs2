<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    // TODO: ต้องมีการจำกัดสิทธิ์ และตรวจการเข้าซ้ำบ่อยๆ
    public function index($any)
    {
        return Storage::response($any);
    }
}
