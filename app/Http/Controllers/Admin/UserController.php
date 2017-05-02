<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * UserController index.
     */
    public function index(Request $request)
    {
        $sort = $request->sort;

        //total
        $total_users = User::withTrashed()->paginate();

        //trashed users
        $trashed_users = User::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate();

        //new users
        $new_users = User::whereDate('created_at', Carbon::now()->toDateString())->paginate();

        //users
        if ($sort == null)
            $users = User::orderBy('created_at', 'DESC')->paginate();

        //new users
        if ($sort == "new")
            $users = $new_users;

        //trashed users
        if ($sort == "trashed")
            $users = $trashed_users;

        return view('v1.admin.users.index')
            ->with('sort', $sort)
            ->with('total_users', $total_users)
            ->with('trashed_users', $trashed_users)
            ->with('new_users', $new_users)
            ->with('users', $users);
    }

    /**
     * UserController view.
     */
    public function view($id)
    {
        //user
        $user = User::find($id);

        if ($user == null)
            abort(404);

        return view('v1.admin.users.view')
            ->with('user', $user);
    }

    /**
     * UserController delete.
     */
    public function delete($id)
    {
        //user
        $user = User::find($id);

        if ($user == null)
            return redirect()->back()->with('error', 'User not found!');

        if ($user->delete())
            return redirect()->back()->with('success', $user->firstname . ' blocked successfully!');

        return redirect()->back()->with('success', 'Failed blocking ' . $user->firstname . '.');

    }

    /**
     * UserController restore.
     */
    public function restore($id)
    {
        //user
        $user = User::onlyTrashed()->where('id', $id)->first();

        if ($user == null)
            return redirect()->back()->with('error', 'User not found!');

        if ($user->restore())
            return redirect()->back()->with('success', $user->firstname . ' restored successfully!');

        return redirect()->back()->with('success', 'Failed restoring ' . $user->firstname . '.');

    }
}
