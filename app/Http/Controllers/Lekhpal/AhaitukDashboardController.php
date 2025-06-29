<?php

namespace App\Http\Controllers\Lekhpal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AhaitukDashboardController extends Controller
{
    public function index()
    {
        return view('lekhpal.ahaituk_dashboard');
    }
}
