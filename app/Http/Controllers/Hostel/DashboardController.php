<?php

namespace App\Http\Controllers\Hostel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handles dashboard view and functionality
     */
    function __invoke()
    {
        return view('hostels.dashboard');
    }

}
