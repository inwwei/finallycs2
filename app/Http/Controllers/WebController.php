<?php

namespace App\Http\Controllers;

class WebController extends Controller
{
    public function loadPage()
    {
        return view('welcome');
    }
}
