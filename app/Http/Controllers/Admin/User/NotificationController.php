<?php

namespace App\Http\Controllers\Admin\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * NotificationController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('v1.admin.notifications')
            ->with('user', $request->user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the notification 'read_at' column in storage.
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function toggleRead(Request $request, $id)
    {
        $notification = $request->user()->notifications()->where('id', $id)->first();

        if ($notification->read_at != null) {
//            $notification->update(['read_at', null]);

            return back()
                ->with('success', $notification->data['title'] . ' notification already marked as read!');
        }

        if ($notification->update(['read_at' => Carbon::now()])) {
            return back()
                ->with('success', str_limit($notification->data['title'], 15) . ' notification marked as read!');
        }

        return back()
            ->with('error', 'Failed marking ' . str_limit($notification->data['title'], 15) . ' notification as read!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $notification = $request->user()->notifications()->where('id', $id)->first();

        if ($notification->delete()) {
            return back()
                ->with('success', str_limit($notification->data['title'], 15) . ' notification deleted!');
        }

        return back()
            ->with('error', 'Failed deleting ' . str_limit($notification->data['title'], 15) . ' notification!');

    }
}
