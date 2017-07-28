<?php

namespace App\Http\Controllers\Hostel;

use App\Models\v1\Company\CompanyApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handles dashboard view and functionality
     * @param Request $request
     * @param $app
     * @return
     */
    function __invoke(Request $request, $app)
    {
        $app = CompanyApp::findOrFail($app);

        return view('hostels.dashboard')
            ->with('app', $app);
    }

}
