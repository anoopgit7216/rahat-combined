<?php

namespace App\Http\Controllers\Lekhpal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LekhpalDashboardController extends Controller
{
    public function index()
    {
        return view('lekhpal.lekhpal_dashboard');
    }

    
}
