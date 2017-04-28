<?php

namespace App\Http\Controllers\Admin;

use App\Models\Support\BugReport;
use App\Models\v1\Company\AppTrial;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * AdminController getDashboard.
     */
    public function getDashboard()
    {
        //users
        $users = User::where('created_at', Carbon::today())->paginate();

        return view('v1.admin.dashboard')
            ->with('users', $users);
    }

    /**
     * AdminController getSettings.
     */
    public function getSettings()
    {
        return view('v1.admin.settings');
    }

    /**
     * AdminController getPages.
     */
    public function getPages()
    {
        return view('v1.admin.pages');
    }
}
