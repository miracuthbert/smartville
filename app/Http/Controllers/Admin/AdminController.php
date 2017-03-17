<?php

namespace App\Http\Controllers\Admin;

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
        $users = User::where('created_at', Carbon::now()->toDateString())->get();

        return view('v1.admin.dashboard')
            ->with('users', $users);
    }

    /**
     * AdminController notifications.
     */
    public function notifications()
    {
        return view('v1.admin.notifications')
            ->with('user', Auth::user());
    }

    /**
     * AdminController notifications.
     */
    public function notificationRead($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if ($notification->read_at != null) {
//            $notification->update(['read_at', null]);

            return back()
                ->with('success', $notification->data['title'] . ' notification already marked as read!');
        }

        if ($notification->markAsRead())
            return back()
                ->with('success', $notification->data['title'] . ' notification marked as read!');

        return back()
            ->with('error', 'Failed marking ' . $notification->data['title'] . ' notification as read!');

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
